<?php

use Illuminate\Support\Facades\Route;

//Visualizar paginas simples--------------------------
Route::view('/', 'login')->name('login');
Route::view('/inicio', 'home')->name('home');
Route::view('/inventario', 'inventary')->name('inventary');
Route::view('/log', 'log')->name('log');



//Gestionar pois ----------------------------
	//Redireccionar sin sección
Route::get('/inventario/gestionar-poi', function () {
    return view('adminPoi', ['section' => 'agregar']);
});

	//Redireccionar a sección
Route::get('/inventario/gestionar-poi/{section}', 'poiCrudController@redirecToSection')->name('poiCrud.redirecToSection');

	//CRUD Crear
Route::post('/inventario/gestionar-poi/agregar', 'poiCrudController@store')->name('poiCrud.store');

	//CRUD Actualizar
Route::post('/inventario/gestionar-poi/modificar', 'poiCrudController@update')->name('poiCrud.update');



//Gestionar tipologias ----------------------------
	//Redireccionar sin sección
Route::get('/inventario/gestionar-tipologias', function () {
    return view('adminTipology', ['section' => 'agregar']);
});

	//Redireccionar a sección
Route::get('/inventario/gestionar-tipologias/{section}', 'tipologiaController@redirecToSection')->name('tipologia.redirecToSection');

	//CRUD Crear
Route::post('/inventario/gestionar-tipologias/agregar', 'tipologiaController@store')->name('tipologia.store');

	//CRUD Actualizar
Route::post('/inventario/gestionar-tipologias/modificar', 'tipologiaController@update')->name('tipologia.update');

		//Obtener tipologias
Route::get('obtener-tipologias', 'tipologiaController@getTipologias')->name('tipologia.getTipologias');

		//Obtener tipologia
Route::get('obtener-tipologia', 'tipologiaController@getTipologia')->name('tipologia.getTipologia');

		//Buscar tipologias
Route::get('buscar-tipologias', 'tipologiaController@searchTipologias')->name('tipologia.searchTipologias');


//Gestionar establecimientos ----------------------------
	//Redireccionar sin sección
Route::get('/inventario/gestionar-establecimientos', function () {
    return view('adminEstablishment', ['section' => 'agregar']);
});

	//Redireccionar a sección
Route::get('/inventario/gestionar-establecimientos/{section}', 'establecimientoController@redirecToSection')->name('establecimiento.redirecToSection');

	//CRUD Crear
Route::post('/inventario/gestionar-establecimientos/agregar', 'establecimientoController@store')->name('establecimiento.store');

	//CRUD Actualizar
Route::post('/inventario/gestionar-establecimientos/modificar', 'establecimientoController@update')->name('establecimiento.update');

//Obtener establecimientos
Route::get('obtener-establecimientos', 'establecimientoController@getEstablecimientos')->name('establecimiento.getEstablecimientos');

		//Obtener tipologia
Route::get('obtener-establecimiento', 'establecimientoController@getEstablecimiento')->name('establecimiento.getEstablecimiento');

		//Buscar establecimientos
Route::get('buscar-establecimientos', 'establecimientoController@searchEstablecimientos')->name('establecimiento.searchEstablecimientos');


//Gestionar poi-factor ----------------------------
	//Redireccionar sin sección
Route::get('/inventario/gestionar-poifactor', function () {
    return view('adminPoiFactor', ['section' => 'emparejar']);
});

	//Redireccionar a sección
Route::get('/inventario/gestionar-poifactor/{section}', 'poiFactorCrudController@redirecToSection')->name('poiFactorCrud.redirecToSection');

	//CRUD Emparejar
Route::post('/inventario/gestionar-poifactor/emparejar', 'poiFactorCrudController@match')->name('poiFactorCrud.match');

	//CRUD Actualizar
Route::post('/inventario/gestionar-poifactor/modificar', 'poiFactorCrudController@update')->name('poiFactorCrud.update');



//Gestionar fórmulas ----------------------------
	//Redireccionar sin sección
Route::get('/gestionar-formula', function () {
    return view('adminFormula', ['section' => 'agregar']);
});

	//Redireccionar a sección
Route::get('/gestionar-formula/{section}', 'formulaCrudController@redirecToSection')->name('formulaCrud.redirecToSection');

	//CRUD Crear
Route::post('/gestionar-formula/agregar', 'formulaCrudController@store')->name('formulaCrud.store');

	//CRUD Actualizar
Route::post('/gestionar-formula/modificar', 'formulaCrudController@update')->name('formulaCrud.update');



//Gestionar administradores ----------------------------
	//Redireccionar sin sección
Route::get('/gestionar-administradores', function () {
    return view('adminAdministrator', ['section' => 'agregar']);
});

	//Redireccionar a sección
Route::get('/gestionar-administradores/{section}', 'administradorCrudController@redirecToSection')->name('administradorCrud.redirecToSection');

	//CRUD Crear
Route::post('/gestionar-administradores/agregar', 'administradorCrudController@store')->name('administradorCrud.store');

	//CRUD Actualizar
Route::post('/gestionar-administradores/modificar', 'administradorCrudController@update')->name('administradorCrud.update');



//Gestionar cuenta ----------------------------
	//Redireccionar a sección
Route::get('/perfil/{alias}', 'cuentaCrudController@redirecToAccount')->name('cuentaCrud.redirecToAccount');

	//CRUD Actualizar (Info. publica)
Route::post('/perfil/publico/{alias}', 'cuentaCrudController@updatePublic')->name('cuentaCrud.updatePersonal');

	//CRUD Actualizar (Contraseña)
Route::post('/perfil/privado/{alias}', 'cuentaCrudController@updatePass')->name('cuentaCrud.updatePass');



//Dinamicos--------------------

//Buscar PoI [AdminPoi]
Route::get('gestionar-poi/buscar-poi-mod', 'poiDynamicController@searchPoi')->name('poiDynamic.searchPoi');

//Traer PoI & PoIxTipologia [AdminPoi]
Route::get('gestionar-poi/traer-poi-mod', 'poiDynamicController@getSelectedPoi')->name('poiDynamic.getSelectedPoi');

//Traer Municipio & Tipologia [AdminPoi]
Route::get('gestionar-poi/llenar-input-pois', 'poiDynamicController@fillAdminPoi')->name('poiDynamic.fillAdminPoi');

//Traer todo Poi [AdminPoi]
Route::get('gestionar-poi/mostrar-pois', 'poiDynamicController@getAllPois')->name('poiDynamic.getAllPois');

//Traer informacion de PoI especifico [AdminPoi]
Route::get('gestionar-poi/traer-poi-esp', 'poiDynamicController@getAllSelectedPoi')->name('poiDynamic.getAllSelectedPoi');

//Traer formulas [AdminFormula]
Route::get('traer-formulas/gestionar-formula', 'formulaDynamicController@getAllForm')->name('formulaDynamic.getAllForm');

//Traer formulas excepto  [AdminFormula]
Route::get('traer-formula/gestionar-formula', 'formulaDynamicController@getForm')->name('formulaDynamic.getForm');

//Traer factores y variables de formula seleccionada -> id,all [AdminFormula]
Route::get('traer-factores/gestionar-formula', 'formulaDynamicController@fillTVarxFac')->name('formulaDynamic.fillTVarxFac');

//Traer factores, subfactores y variables de formula seleccionada -> id [AdminFormula]
Route::get('traer-factoresyvariables/gestionar-formula', 'formulaDynamicController@fillTVarxFacxSfac')->name('formulaDynamic.fillTVarxFacxSfac');

//Traer factores y formula_formula [AdminFormula]
Route::get('gestionar-formula/traer-formula/{quantity}', 'formulaDynamicController@fillTableFormula')->name('formulaDynamic.fillTableFormula');

//Obtiene los pois que no tiene emparejamientos completos con los factores [AdminFactorPoi]
Route::get('gestionar-factorpoi/poisvfactores', 'poiFactorDynamicController@getPoisNoF')->name('poiFactorDynamic.getPoisNoF');

//Obtiene los factores no emparejados de un PoI seleccionado [AdminFactorPoi]
Route::get('gestionar-factorpoi/spoivfactores', 'poiFactorDynamicController@getSPoiNoF')->name('poiFactorDynamic.getSPoiNoF');

//Buscar PoI [AdminFactorPoi]
Route::get('gestionar-factorpoi/buscar-poi', 'poiFactorDynamicController@searchPois')->name('poiFactorDynamic.searchPois');

//Obtener factores emparejados de PoI seleccionado [AdminFactorPoi]
Route::get('gestionar-factorpoi/trae-factores-spoi', 'poiFactorDynamicController@getFactoreSPoi')->name('poiFactorDynamic.getFactoreSPoi');

//Obtener factores de poi seleccionado ->id&name
Route::get('gestionar-factorpoi/traer-apoi', 'poiFactorDynamicController@getFacxsPoi')->name('poiFactorDynamic.getFacxsPoi');

//Buscar todas tipologias ->term
Route::get('gestionar-tipologias/buscar-tip', 'tipologiaDynamicController@searchTip')->name('tipologiaDynamic.searchTip');

//Buscar tipologias ->term,state
Route::get('gestionar-tipologias/buscar-atip', 'tipologiaDynamicController@searchATip')->name('tipologiaDynamic.searchATip');

//Obtener info tipologia seleccionado ->id
Route::get('gestionar-tipologias/traer-stip', 'tipologiaDynamicController@getSelectedTip')->name('tipologiaDynamic.getSelectedTip');

//Obtener roles activos
Route::get('gestionar-admin/traer-aroles', 'administradoresDynamicController@fillRoles')->name('administradoresDynamic.fillRoles');

//Buscar usuario ->term,state
Route::get('gestionar-admin/buscar-usuario', 'administradoresDynamicController@searchUser')->name('administradoresDynamic.searchUser');

//Obtener toda info usuario seleccionado ->id
Route::get('gestionar-admin/traer-allsusuario', 'administradoresDynamicController@getAllSelectedUser')->name('administradoresDynamic.getAllSelectedUser');

//Buscar usuario ->term
Route::get('gestionar-admin/buscar-todos-usuarios', 'administradoresDynamicController@searchAllUser')->name('administradoresDynamic.searchAllUser');

//Obtener info usuario seleccionado ->id
Route::get('gestionar-admin/traer-susuario', 'administradoresDynamicController@getSelectedUser')->name('administradoresDynamic.getSelectedUser');

//Obtener secciones, eventos y, primera y última fecha de log
Route::get('traer-elementos-log/log', 'logDynamicController@fillLogElements')->name('logDynamic.fillLogElements');

//Buscar administradores activo ->term
Route::get('buscar-administradores/log', 'logDynamicController@searchUser')->name('logDynamic.searchUser');

//Obtener logs ->term
Route::get('obtener-log/log', 'logDynamicController@consultLog')->name('logDynamic.consultLog');


//Global
Route::get('obtener-municipios', 'getGRecordsController@getMunicipios')->name('getGRecords.getMunicipios');

Route::get('obtener-tipos-establecimientos', 'getGRecordsController@getTipos')->name('getGRecords.getTipos');

Route::get('obtener-roles', 'getGRecordsController@getRoles')->name('getGRecords.getRoles');

//Revisa si los pois tienen inicializados todos los factores activos [Loged]
Route::get('advertencia-poixfactor', 'inspectPvFController@inspectPoivFactor')->name('inspectPvF.inspectPoivFactor');


	//Crear storage-link accediendo a la dirección URL "storage-link"
Route::get('storage-link', function(){
	if(file_exists(public_path('storage'))){
		return 'El directorio "public/storage" ya existe.';
	}

	app('files')->link(
		storage_path('app/public'), public_path('storage')
	);

	return 'El directorio "public/storage" a sido creado.';
});

//Autenticacion------------------------
Auth::routes();