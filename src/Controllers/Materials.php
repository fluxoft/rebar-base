<?php

namespace RebarBase\Controllers;

use Fluxoft\Rebar\Container;
use Fluxoft\Rebar\Http\Presenters\JsonPresenter;
use RebarBase\Services\MaterialsService;

class Materials extends BaseWebController {
	private MaterialsService $service;

	public function Setup(Container $container) {
		parent::Setup($container);
		$this->service = $container['MaterialsService'];
	}

	/**
	 * Fetch and display all materials.
	 */
	public function Default() {
		$materials = $this->service->FetchAll();

		$this->response->AddData('title', 'All Materials');
		$this->response->AddData('materials', $materials);

		$json = $this->request->Get('json');
		if ($json) {
			$this->response->Presenter = new JsonPresenter();
		} else {
			$this->response->Presenter->Template = 'materials/default.phtml';
		}
	}

	/**
	 * Fetch and display a single material by ID.
	 */
	public function View($id = null) {
		if ($id === null) {
			$this->response->Status = 400;
			$this->response->Body = 'Bad Request: No ID provided.';
			return;
		}

		$material = $this->service->Fetch((int) $id);

		if ($material === null) {
			$this->response->Status = 404;
			$this->response->Body = 'Material not found.';
			return;
		}

		$this->response->AddData('title', $material->Name);
		$this->response->AddData('material', $material);

		$this->response->Presenter->Template = 'materials/view.phtml';
	}

	/**
	 * Show the edit form for a material or create a new one.
	 */
	public function Edit($id = null) {
		$material = $id !== null ? $this->service->Fetch((int) $id) : null;

		$this->response->AddData('title', $material ? 'Edit Material: ' . $material->Name : 'Add New Material');
		$this->response->AddData('material', $material);

		$this->response->Presenter->Template = 'materials/edit.phtml';
	}

	/**
	 * Handle the POST request to save a material (create or update).
	 */
	public function Save() {
		$Id        = $this->request->Post('Id');
		$Name      = $this->request->Post('Name');
		$Quantity  = (int)$this->request->Post('Quantity');
		$UnitPrice = (float)$this->request->Post('UnitPrice');

		$data = compact('Name', 'Quantity', 'UnitPrice');

		if ($Id) {
			$this->service->Update($Id, $data);
		} else {
			$this->service->Create($data);
		}

		$this->response->Redirect('/materials');
	}

	public function Delete($id = null): void {
		if ($id === null) {
			$this->response->Halt(400, 'Bad Request: No ID provided.');
		}

		try {
			$this->service->Delete((int) $id);
			$this->response->Redirect('/materials');
		} catch (\InvalidArgumentException $e) {
			$this->response->Halt(404, 'Material not found.');
		} catch (\Exception $e) {
			$this->response->Halt(500, 'An error occurred while deleting the material.');
		}
	}
}
