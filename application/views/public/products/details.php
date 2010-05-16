<dl>
	<dt>Nazwa</dt>
	<dd><?php echo $product->name ?></dd>
	
	<dt>Opis</dt>
	<dd><?php echo $product->description ?></dd>
	
	<dt>Cena netto</dt>
	<dd><?php echo number_format($product->price->value, 2) ?></dd>
	
	<dt>Cena brutto</dt>
	<dd><?php echo number_format($product->price->value*(1 + (double) $product->price->vat->value), 2) ?></dd>
	
	<dt>VAT</dt>
	<dd><?php echo $product->price->vat->name ?></dd>
</dl>