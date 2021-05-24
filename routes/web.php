<?php

use Illuminate\Support\Facades\Route;

//Rutas simples de views--------------------------
Route::view('/', 'login')->name('login');
Route::view('/inicio', 'home')->name('home');
Route::view('/inventario', 'inventary')->name('inventary');
Route::view('/log', 'log')->name('log');


//Redireccion----------------------
//No 'Seccion' en AdminPoi
Route::get('/inventario/gestionar-poi', 'adminPoiController@nullSection')->name('adminPoi.nullSection');

//No 'Seccion' en AdminFactor
Route::get('/gestionar-formula', 'adminFormulaController@nullSection')->name('adminFormula.nullSection');

//No 'Secciones' AdminFactorPoi
Route::get('/inventario/gestionar-poifactor', 'adminPoiFactorController@nullSection')->name('adminPoiFactor.nullSection');

//No 'Secciones' AdminTip
Route::get('/inventario/gestionar-tipologias', 'adminTipologiasController@nullSection')->name('adminTipologias.nullSection');

//No 'Secciones' AdminAdministradores
Route::get('/gestionar-administradores', 'adminAdministradoresController@nullSection')->name('adminAdministradores.nullSection');

//No 'Secciones' AdminEstablecimiento
Route::get('/gestionar-establecimientos', 'adminEstablecimientoController@nullSection')->name('adminEstablecimiento.nullSection');



//Formularios-----------
//Agregar PoI [AdminPoi]
Route::post('/inventario/gestionar-poi/agregar', 'adminPoiController@store')->name('adminPoi.store');

//Modificar PoI [AdminPoi]
Route::post('/inventario/gestionar-poi/modificar', 'adminPoiController@update')->name('adminPoi.update');

//Modificar [AdminFormula]
Route::post('/gestionar-formula/modificar', 'adminFormulaController@update')->name('adminFormula.update');

//Agregar [AdminFormula]
Route::post('/gestionar-formula/agregar', 'adminFormulaController@store')->name('adminFormula.store');

//Emparejar factores-PoIs [AdminFactorPoi]
Route::post('/inventario/gestionar-poifactor/emparejar', 'adminPoiFactorController@store')->name('adminPoiFactor.store');

//Modificar valores Factores-PoIs [AdminFactorPoi]
Route::post('/inventario/gestionar-poifactor/modificar', 'adminPoiFactorController@update')->name('adminPoiFactor.update');

//Agregar[AdminTipologias]
Route::post('/inventario/gestionar-tipologias/agregar', 'adminTipologiasController@store')->name('adminTipologias.store');

//Modificar [AdminTipologias]
Route::post('/inventario/gestionar-tipologias/modificar', 'adminTipologiasController@update')->name('adminTipologias.update');

//Agregar [AdminAdministradores]
Route::post('/gestionar-administradores/agregar', 'adminAdministradoresController@store')->name('adminAdministradores.store');

//Modificar [AdminAdministradores]
Route::post('/gestionar-administradores/modificar', 'adminAdministradoresController@update')->name('adminAdministradores.update');

//Modificar Info. Personal [AdminCuenta]
Route::post('/perfil/personal/{alias}', 'adminCuentaController@updatePersonal')->name('adminCuenta.updatePersonal');

//Modificar Contraseña [AdminCuenta]
Route::post('/perfil/pass/{alias}', 'adminCuentaController@updatePass')->name('adminCuenta.updatePass');

//Agregar[AdminEstablecimiento]
Route::post('/inventario/gestionar-establecimientos/agregar', 'adminEstablecimientoController@store')->name('adminEstablecimiento.store');

//Modificar [AdminEstablecimiento]
Route::post('/inventario/gestionar-establecimientos/modificar', 'adminEstablecimientoController@update')->name('adminEstablecimiento.update');



//Envio de variables-------------------
//'Secciones' AdminPoI
Route::get('/inventario/gestionar-poi/{section}', 'adminPoiController@redirecToSection')->name('adminPoi.redirecToSection');

//'Secciones' AdminFormula
Route::get('/gestionar-formula/{section}', 'adminFormulaController@redirecToSection')->name('adminFormula.redirecToSection');

//'Secciones' AdminFactorPoi
Route::get('/inventario/gestionar-poifactor/{section}', 'adminPoiFactorController@redirecToSection')->name('adminPoiFactor.redirecToSection');

//'Secciones' AdminFactorPoi
Route::get('/inventario/gestionar-tipologias/{section}', 'adminTipologiasController@redirecToSection')->name('adminTipologias.redirecToSection');

//'Secciones' AdminAdministradores
Route::get('/gestionar-administradores/{section}', 'adminAdministradoresController@redirecToSection')->name('adminAdministradores.redirecToSection');

//Peril AdminCuenta
Route::get('/perfil/{alias}', 'adminCuentaController@redirecToAccount')->name('adminCuenta.redirecToAccount');

//'Secciones' AdminEstablecimiento
Route::get('/inventario/gestionar-establecimientos/{section}', 'adminEstablecimientoController@redirecToSection')->name('adminEstablecimiento.redirecToSection');


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
Route::get('traer-formulas/gestionar-formula', 'factorDynamicController@getAllForm')->name('factorDynamic.getAllForm');

//Traer formulas excepto  [AdminFormula]
Route::get('traer-formula/gestionar-formula', 'factorDynamicController@getForm')->name('factorDynamic.getForm');

//Traer factores y variables de formula seleccionada -> id,all [AdminFormula]
Route::get('traer-factores/gestionar-formula', 'factorDynamicController@fillTVarxFac')->name('factorDynamic.fillTVarxFac');

//Traer factores, subfactores y variables de formula seleccionada -> id [AdminFormula]
Route::get('traer-factoresyvariables/gestionar-formula', 'factorDynamicController@fillTVarxFacxSfac')->name('factorDynamic.fillTVarxFacxSfac');

//Traer factores y formula_formula [AdminFormula]
Route::get('gestionar-formula/traer-formula/{quantity}', 'factorDynamicController@fillTableFormula')->name('factorDynamic.fillTableFormula');

//Revisa si los pois tienen inicializados todos los factores activos [Loged]
Route::get('inicio/advertencia-poixfactor', 'PoifactorDynamicController@inspectPoi')->name('poiFactorDynamic.inspectPoi');

//Obtiene los pois que no tiene emparejamientos completos con los factores [AdminFactorPoi]
Route::get('gestionar-factorpoi/poisvfactores', 'poiFactorDynamicController@getPoisNoF')->name('poiFactorDynamic.getPoisNoF');

//Obtiene los factores no emparejados de un PoI seleccionado [AdminFactorPoi]
Route::get('gestionar-factorpoi/spoivfactores', 'poiFactorDynamicController@getSPoiNoF')->name('poiFactorDynamic.getSPoiNoF');

//Buscar PoI [AdminFactorPoi]
Route::get('gestionar-factorpoi/buscar-poi', 'poiFactorDynamicController@searchPois')->name('poiFactorDynamic.searchPois');

//Obtener factores emparejados de PoI seleccionado [AdminFactorPoi]
Route::get('gestionar-factorpoi/trae-factores-spoi', 'poiFactorDynamicController@getFactoreSPoi')->name('poiFactorDynamic.getFactoreSPoi');

//Buscar pois activos ->term
Route::get('gestionar-factorpoi/buscar-apoi', 'poiFactorDynamicController@searchAPois')->name('poiFactorDynamic.searchAPois');

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

//Autenticacion------------------------
Auth::routes();