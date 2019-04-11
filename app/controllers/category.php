<?php

class Category extends Controllers {

	public function main($slug = null)
	{
		$db = $this->model('Category_Model');
		if (empty($slug))
		{
			echo json_encode($db->read());
		}
		else {
			echo json_encode($db->read($slug, 'slug'));
		}
	}


	public function create()
	{
		$db = $this->model('Category_Model');
		$data = (object)$_POST;
		$error = 0;

		$data->slug = empty($data->slug) ? $this->plugin->slugify($data->name) : $data->slug;

		if (empty($data->name)) {
			$error = 1;
			$json['error'] = 1;
			$json['message'] = 'Name is empty.';
		} elseif ($db->exists($data->slug)) {
			$error = 1;
			$json['error'] = 1;
			$json['message'] = 'Category already exists.';
		} elseif (strlen($data->name) < 3) {
			$error = 1;
			$json['error'] = 1;
			$json['message'] = 'Name minimum is 3.';
		} elseif (strlen($data->name) > 20) {
			$error = 1;
			$json['error'] = 1;
			$json['message'] = 'Name maximum is 20.';
		} elseif (!$error) {
			if ($db->create($data))
			{
				$json['error'] = 0;
				$json['message'] = 'Category was successfuly created.';
			}
			else {
				$json['error'] = 1;
				$json['message'] = 'Failed to create new category.';
			}
		}

		echo json_encode($json);
	}


	public function delete()
	{
		$db = $this->model('Category_Model');
		$slug = @$_POST['slug'];
		$error = 0;

		if (empty($slug)) {
			$error = 1;
			$json['error'] = 1;
			$json['message'] = 'Slug is not defined.';
		} elseif (!$db->exists($slug)) {
			$error = 1;
			$json['error'] = 1;
			$json['message'] = 'Category not found.';
		} elseif (!$error) {
			$db->delete($slug);
			if ($db->exists($slug)) {
				$json['error'] = 1;
				$json['message'] = 'Failed to delete category.';
			}
			else {
				$json['error'] = 0;
				$json['message'] = 'Category was successfuly deleted.';
			}
		}

		echo json_encode($json);
	}

}