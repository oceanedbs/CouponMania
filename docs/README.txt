Variazioni rispetto al progetto precedente (ZendProject2)
======
- Layout admin
	+ Eliminato <div> header rispetto a main
	+ CSS per <body> (id=bodyadmin)
	+ Creati _topnavadmin.phtml e _topnavmain.phtml
- Creazione Form: forms/Admin/Products/Add.php
    NOTE:
	+ Validators: array('Count', false, 1); secondo parametro a true=non attivare i 
	  validators seguenti
	+ Validatore Float: specifico il filtro per trasformare il separatore dei
	  decimali da vigola a punto (altrimenti non posso registrare correttamente il 
	  valore in MySQL), ma conseguentemente debbo definire il locale en_US per il
	  validatore (N.B. prima ZF applica i filtri e poi valida il dato!)
- Creazione AdminController
- Creazion modello models/Admin.php
	+ Aggiunta metodo insertProduct() in models/resources/Product.php
- Viste aggiunte:
	+ views/scripts/admin/index.phtml
	+ views/scripts/admin/newproduct.phtml
