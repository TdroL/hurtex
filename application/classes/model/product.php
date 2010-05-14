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
			->load_with(array('price'));
	}
	
	public function save($key = NULL)
	{
		parent::save($key);

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