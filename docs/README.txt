Variazioni rispetto al progetto precedente (ZendProject0)
======
- Eliminazione cartella tests/
- Scelta layout: Exploitable by Free CSS Template
- In public/
	+ creazione cartelle css/ e images/ con gli elementi del tema scelto
- In application.ini:
	+ placeholder doctype()
	+ definizione path cartella layouts
- In Bootstrap.php:
	+ inizializzazione placeholders in _initViewSettings()
	+ definizione _initRequest() per poter usare il corretto baseUrl() in _initViewSettings().
- Creazione cartella application/layouts
	+ sottocartella script: creazione main.phtml e _topnavmain.phtml
- Controllers:
	+ modifica indexController per attivazione publicController di default
	+ modifica errorController per disattivazione layout
	+ definizione publicController
- View Scripts
	+ eliminazione index.phtml e relativa cartella
	+ modifica views/scripts/error/error.phtml per aggiungere placeholder doctype()
	+ creazione: 
		- views/scripts/public/index.phtml
		- views/scripts/public/who.phtml
		- views/scripts/public/where.phtml
	+ view-helper:
		- views/helpers/ProductImg.phtml
		- views/helpers/ProductPrice.phtml
- Modalità 'development' in .htaccess
- In Bootstrap.php definizione logger FireBug 
