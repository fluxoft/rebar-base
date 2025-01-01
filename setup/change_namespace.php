<?php

require_once __DIR__ . '/../vendor/autoload.php';

function getUserInput(string $prompt, string $default = ''): string {
	echo $prompt . ($default ? " [$default]" : '') . ': ';
	$input = trim(fgets(STDIN));
	return $input !== '' ? $input : $default;
}

function replaceInFile(string $filePath, array $replacements): bool {
	$content = file_get_contents($filePath);
	if ($content === false) {
		return false;
	}

	$newContent = str_replace(array_keys($replacements), array_values($replacements), $content);

	return file_put_contents($filePath, $newContent) !== false;
}

function rollback(array $backups): void {
	foreach ($backups as $original => $backup) {
		if (file_exists($backup)) {
			copy($backup, $original);
			unlink($backup);
		}
	}
}

try {
	// Step 1: Load composer.json and determine the current namespace
	$composerJsonPath = __DIR__ . '/../composer.json';
	$composerData = json_decode(file_get_contents($composerJsonPath), true);
	if (!isset($composerData['autoload']['psr-4'])) {
		throw new RuntimeException("PSR-4 autoload section not found in composer.json");
	}

	$currentNamespace = array_key_first($composerData['autoload']['psr-4']);
	$defaultPath = $composerData['autoload']['psr-4'][$currentNamespace];
	var_dump($defaultPath);

	// Step 2: Prompt for namespaces
	$newNamespace = getUserInput('Enter the new namespace', $currentNamespace);
	// make sure $newNamespace ends with a backslash
	$newNamespace = (substr($newNamespace, -1) === '\\') ? $newNamespace : $newNamespace . '\\';

	// Step 3: Backup composer.json
	$composerBackupPath = $composerJsonPath . '.bak';
	copy($composerJsonPath, $composerBackupPath);

	// Step 4: Replace namespaces in composer.json
	$composerData['autoload']['psr-4'] = [
		$newNamespace => $defaultPath,
		'Fluxoft\\Rebar\\' => 'rebar/' // Keep this unchanged
	];
	file_put_contents($composerJsonPath, json_encode($composerData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

	// Step 5: Find and replace namespaces in source files
	$directoriesToSearch = [
		__DIR__ . '/../src/',
		__DIR__ . '/../app/'
	];

	$backups = [];
	foreach ($directoriesToSearch as $dir) {
		$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

		foreach ($iterator as $file) {
			if ($file->isFile() && $file->getExtension() === 'php') {
				$backupPath = $file->getPathname() . '.bak';
				copy($file->getPathname(), $backupPath);
				$backups[$file->getPathname()] = $backupPath;

				$trimmedCurrentNamespace = rtrim($currentNamespace, '\\');
				$trimmedNewNamespace     = rtrim($newNamespace, '\\');

				$replacements = [
					// Replace "namespace" declarations
					"namespace $trimmedCurrentNamespace" => "namespace $trimmedNewNamespace",

					// Replace "use" statements
					"use $trimmedCurrentNamespace" => "use $trimmedNewNamespace",

					// Replace "@package" annotations
					"@package $trimmedCurrentNamespace" => "@package $trimmedNewNamespace",

					// Replace "@var" annotations
					"@var \\\\$trimmedCurrentNamespace" => "@var \\\\$trimmedNewNamespace",

					// Replace string literals (escaped backslashes)
					"'{$trimmedCurrentNamespace}\\\\Mappers\\\\'" => "'{$trimmedNewNamespace}\\\\Mappers\\\\'",
					"'{$trimmedCurrentNamespace}\\\\Models\\\\'" => "'{$trimmedNewNamespace}\\\\Models\\\\'",
					"'{$trimmedCurrentNamespace}\\\\Controllers\\\\'" => "'{$trimmedNewNamespace}\\\\Controllers\\\\'",
				];

				if (!replaceInFile($file->getPathname(), $replacements)) {
					throw new RuntimeException("Failed to modify {$file->getPathname()}");
				}
			}
		}
	}

	// Step 6: Run composer dump-autoload
	system('composer dump-autoload');

	echo "Namespace successfully updated to '$newNamespace'.\n";

	// Step 7: Clean up .bak files
	foreach ($backups as $backup) {
		if (file_exists($backup)) {
			unlink($backup);
		}
	}
	unlink($composerBackupPath);
	echo "Backup files cleaned up.\n";

} catch (Exception $e) {
	echo "Error: {$e->getMessage()}\n";

	// Rollback changes
	if (isset($composerBackupPath) && file_exists($composerBackupPath)) {
		copy($composerBackupPath, $composerJsonPath);
		unlink($composerBackupPath);
	}
	if (isset($backups)) {
		rollback($backups);
	}

	exit(1);
}
