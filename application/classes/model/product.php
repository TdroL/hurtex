<?php defined('SYSPATH') or die('No direct script access.');

class Model_Product extends Jelly_Model
{

	public $_late_update = array();

	public static function initialize(Jelly_Meta $meta)
	{
		$meta->fields(array(
				'id' => new Field_Primary,
				'name' => new Field_String(array(
					'label' => 'Nazwa',
					'rules' => array(
						'not_empty' => NULL,
					),
				)),
				'description' => new Field_Text(array(
					'label' => 'Opis',
					'rules' => array(
						'not_empty' => NULL,
					),
				)),
				'image' => new Field_File(array(
					'label' => 'Miniaturka',
					'path' => 'media/images/products',
					'rules' => array(
						'Upload::type' => array(array('jpg', 'png', 'gif')),
					),
				)),
				'current_image' => new Field_String(array(
					'in_db' => FALSE,
				)),
				'category' => new Field_Category(array(
					'label' => 'Kategoria',
					'no_root' => TRUE, // nie wyświetlaj kategorii "Brak"
				)),
				'unit' => new Field_BelongsTo(array(
					'label' => 'Jednostka miary',
				)),
				'quantity' => new Field_Float(array(
					'label' => 'Ilość',
				)),
				'minimal_quantity' => new Field_Float(array(
					'label' => 'Minimalna ilość',
				)),
				'price' => new Field_Price(array(
					'label' => 'Cena',
				)),
				'orders' => new Field_ManyToMany(array(
				)),
				'suppliers' => new Field_ManyToMany(array(
				)),
				'supplies' => new Field_ManyToMany(array(
				)),
			))
			->load_with(array('price'))
			->sorting(array(':name_key' => 'ASC'));
	}
	
	public function save($key = NULL)
	{
		parent::save($key);

		try
		{
			DB::begin();
			DB::delete('product_search')->where('product_id', '=', $this->id)->execute();
			DB::insert('product_search')->values(array(
					'product_id' => $this->id,
					'name' => $this->name,
					'fulltext' => $this->description,
				))->execute();
			DB::commit();
		}
		catch (Exception $e)
		{
			DB::rollback();
		}
		

		if(!empty($this->_late_update))
		{
			foreach($this->_late_update as $v)
			{
				list($model, $related, $field) = $v;
				$model->{$related} = $this->{$field};
				$model->save();
			}
		}
	}

	public function delete($key = NULL)
	{
		if(parent::delete($key))
		{
			DB::delete('product_search')->where('product_id', '=', $this->id)->execute();
			return TRUE;
		}
		return FALSE;
	}

	public function find_by_category($id)
	{
		return $this->where('category_id', '=', (int) $id)
					->execute();
	}

	public function find_by_id($id)
	{
		return $this->where('id', '=', (int) $id)
					->limit(1)
					->execute()
					->current();
	}
}