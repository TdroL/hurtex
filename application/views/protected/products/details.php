<dl><?php echo html::image('media/images/products/'.$product->image, array('title' => $product->name, 'width' => 100)) ?></dl>
<dl>
	<dt><b>Nazwa produktu</b></dt>
	<dd><?php echo $product->name ?></dd>
	
	<dt><b>Opis</b></dt>
	<dd><?php echo $product->description ?></dd>
	
	<dt><b>Cena netto</b></dt>
	<dd><?php echo number_format($product->price->value, 2) ?></dd>
	
	<dt><b>Cena brutto</b></dt>
	<dd><?php echo number_format($product->price->value*(1 + (double) $product->price->vat->value), 2) ?></dd>
	
	<dt><b>VAT</b></dt>
	<dd><?php echo $product->price->vat->name ?></dd>
</dl>