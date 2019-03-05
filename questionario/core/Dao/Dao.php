<?php
	interface Dao{
		public function save($model);
		public function update($model);
		public function findById($id);
		public function findAll();
		public function delete($id);
	}
?>