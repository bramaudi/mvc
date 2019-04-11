<?php

class Category_Model extends Database
{

	public function create($data)
	{
		$this->query("
		INSERT INTO tb_categories
		SET	name = ?, slug = ?
		");
		$this->bind(1, $data->name);
		$this->bind(2, $data->slug);
		$this->execute();

		return $this->exists($data->slug) ? true: false;
	}


	public function read($key = null, $type = null)
	{
		if (empty($key))
		{
			$this->query("
				SELECT *
				FROM tb_categories
				ORDER BY name
			");
			$this->execute();
			return $this->return('fetchAll', PDO::FETCH_OBJ);
		}
		elseif ($type == 'slug')
		{
			$this->query("
				SELECT *
				FROM tb_categories
				WHERE slug = ?
			");
			$this->bind(1, $key);
			$this->execute();
			return $this->return('fetch', PDO::FETCH_OBJ);
		}
		elseif ($type == 'id') {
			$this->query("
				SELECT *
				FROM tb_categories
				WHERE id = ?
			");
			$this->bind(1, $key);
			$this->execute();
			return $this->return('fetch', PDO::FETCH_OBJ);
		}
	}


	public function delete($slug)
	{
		$this->query("DELETE FROM tb_categories WHERE slug = ?");
		$this->bind(1, $slug);
		$this->execute();
	}


	public function exists($slug)
	{
		return $this->num_rows("SELECT COUNT(id) FROM tb_categories WHERE slug = '".$slug."'");
	}
}