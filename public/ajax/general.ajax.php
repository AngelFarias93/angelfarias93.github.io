<?php
require_once dirname(__DIR__, 2) . "/vendor/autoload.php";
require_once dirname(__DIR__, 2) . "/database/database.php";
require_once dirname(__DIR__, 2) . "/config/global.php";
require_once dirname(__DIR__, 2) . "/core/ControladorBase.php";
require_once dirname(__DIR__, 2) . "/app/Controllers/AlmacenesController.php";

use Illuminate\Database\Capsule\Manager as Capsule;

class registroPeticionesAjax extends ControladorBase
{
    public function __construct()
    {
        require_once dirname(__DIR__, 2) . "/core/Conectar.php";
        require_once dirname(__DIR__, 2) . "/core/EntidadBase.php";
        require_once dirname(__DIR__, 2) . "/app/Models/GeneralModel.php";
        require_once dirname(__DIR__, 2) . "/app/Models/AlmacenesModel.php";
        parent::__construct();

        $this->conectar = new Conectar();
        $this->adapter = $this->conectar->conexion();
    }
    /*=============================================
	MENSAJES DE PETICIONES AJAX
    =============================================*/
    public $xhr;
    public $status;
    public $typeResearch;
    public $infoDetails;
    public $idSearchFast;
    public $lockSession;
    public $typeReport;
    public $typeRequest;
    public $typeTransport;

    /*=============================================
	MOSTRAR DATATABLE
    =============================================*/
    public function ajaxShowInfoInvoice()
    {
        $valU = new AlmacenesController();
        $typeResearch = my_decrypt($this->typeResearch,"TECSOLT");
        $infoDetails = my_decrypt($this->infoDetails,"TECSOLT");
        $filtro = array(
            "importaciones_desglose_cargas.big_box_no",
            "importaciones_desglose_cargas.box_no",
            "importaciones_desglose_cargas.imei_meid_1",
            "dis.distribucion_name",
            "importaciones_desglose_cargas.new_pallet",
            "importaciones_desglose_cargas.new_master_box"
        );
        $params = "importaciones_desglose_cargas.*, 
        iuc.imei AS imeiUC, iuc.status AS statusUC, iuc.id_producto AS idProductoUC,
        iuchom.imei AS imeiUCH, iuchom.id_distribucion, iuchom.created_at AS fechaHomologacion, iuchom.reception_at AS fechaRecepcion, 
        dis.distribucion_name AS distribucionName";
        $paramsLeft = "LEFT JOIN inventarios_unidades_completas AS iuc ON importaciones_desglose_cargas.imei_meid_1  = iuc.imei 
        LEFT JOIN inventarios_unidades_completas_homologacion AS iuchom ON importaciones_desglose_cargas.imei_meid_1 = iuchom.imei 
        LEFT JOIN distribuciones AS dis ON iuchom.id_distribucion = dis.id";
        $whereC = ($typeResearch === "pallet")?"importaciones_desglose_cargas.big_box_no = '".$infoDetails."'":"importaciones_desglose_cargas.box_no = '".$infoDetails."'";
        $infoInvoice = $valU->traerAjaxDinamicAll("importaciones_desglose_cargas", $filtro, $params, $paramsLeft, $whereC);

        $datos = $infoInvoice["data"];
        if (count($datos) == 0) {
            echo json_encode(
                array(
                    'draw' => $_POST['draw'],
                    'data' => [],
                    'recordsFiltered' => 0,
                    'recordsTotal' => 0
                )
            );
            return;
        }

        for ($i = 0; $i < count($datos); $i++) {
            //STATUS DE HOMOLOGACIÓN
            $status = (isset($datos[$i]["imeiUCH"]) && !empty($datos[$i]["imeiUCH"]))?'<span class="badge bg-primary">Si</span>':'<span class="badge bg-light">No</span>';
            $nameDis = (isset($datos[$i]["distribucionName"]) && !empty($datos[$i]["distribucionName"]))?$datos[$i]["distribucionName"]:"N/A";
            $newPallet = (isset($datos[$i]["new_pallet"]) && !empty($datos[$i]["new_pallet"]))?$datos[$i]["new_pallet"]:"N/A";
            $newCaja = (isset($datos[$i]["new_master_box"]) && !empty($datos[$i]["new_master_box"]))?$datos[$i]["new_master_box"]:"N/A";

            $arrayData[] = array(
                "id" => ($i + 1),
                "big_box_no" => $datos[$i]["big_box_no"],
                "box_no" => $datos[$i]["box_no"],
                "imei" => $datos[$i]["imei_meid_1"],
                "status" => $status,
                "name_distribucion" => $nameDis,
                "new_pallet" => $newPallet,
                "new_caja_master" => $newCaja
            );
        }

        $ArrayPrint = array(
            "draw" => intval($infoInvoice["draw"]),
            "iTotalRecords" => intval($infoInvoice["iTotalRecords"]),
            "iTotalDisplayRecords" => intval($infoInvoice["iTotalDisplayRecords"]),
            "data" => $arrayData
        );

        echo json_encode($ArrayPrint, JSON_HEX_QUOT | JSON_HEX_TAG);
    }

    public function ajaxDeleteSubcliente()
    {
        $timer = 500;
        $messages = "¡Disculpa las molestias, pero hubo un error en el proceso, ya se notificó al equipo de TECSOLT!";
        try{
            $xhr = $this->xhr;
            $status = $this->status;
            //
            $objXhr = json_decode($xhr,true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                echo json_encode(array("success" => false, "messages" => $messages), true);
                return;
            }
            //GUARDAMOS EL LOG
            if(is_array($objXhr)){
                $obj_ajax = new GeneralModel("null",$this->adapter);
                $msgExtra = "Mensaje Error:".$objXhr["responseText"].", Fecha:".date("d-m-Y").", Usuario: (".$_SESSION["id"].") - ".$_SESSION["nombre"]." ".$_SESSION["apellido"];
                error_log($msgExtra, 3, "../../php.peticiones-ajax.log");
            }
            $array = array("success" => false, "messages" => $messages, "timer" => $timer);
            echo json_encode($array, true);
        } catch (\Exception $e){
            $array = array("success" => false, "messages" => $e->getMessage(), "timer" => $timer);
            echo json_encode($array, true);
        }
    }

    public function ajaxLockSession()
    {
        try{
            $lockSession = $this->lockSession;
            if($lockSession){
                $_SESSION["bloqueoSesion"] = true;
            } else {
                $_SESSION["bloqueoSesion"] = false;
            }
            $array = array("success" => true, "messages" => true, "timer" => 4000);
            echo json_encode($array, true);
        } catch (\Exception $e){
            $array = array("success" => false, "messages" => $e->getMessage(), "timer" => $timer);
            echo json_encode($array, true);
        }
    }

    public function ajaxSearchFast()
    {
        $modal = '<div class="row d-flex justify-content-center align-items-center align-self-center">
            <div class="col-12 text-center mb-4">
                <i class="fas fa-barcode-read fa-4x text-muted mb-3"></i>
                <h4 class="text-muted font-weight-bold mb-1">¡Oh oh! Houston Tenemos un Problema</h4>
                <p class="text-muted mb-1">El código QR o de barras que escaneaste no se pudo encontrar en el sistema. ¡Inténtalo de nuevo!</p>
                <div class="printTable">
                    <div class="imagenTmp" style="width:250px;display:block; margin: auto !important;">
                        <img class="img-thumbnail d-block m-auto border-0 shadow-none" src="'.RUTA.'public/img/error_search.gif">
                    </div>
                </div>
            </div>
        </div>';
        $messages = '¡Ocurrio un problema con las búsqueda, verifica lo que acabas de escanear!';
        $val = false;
        try {
            $valU = new AlmacenesController();
            $idSearchFast = $this->idSearchFast;
            /*=============================================
            INFORMACION DE IMPORTACIÓN
            =============================================*/
            $countValSearch = strlen($idSearchFast);
            // var_dump($countValSearch);
            //RECEPCION DE MERCANCIA
            $msgRecepcion = '<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
            <div class="alert alert-danger">
                <h5 class="font-weight-bold my-0"><i class="icon fas fa-times mr-2"></i>¡Mercancía NO recepcionada!</h5>
            </div>
        </div>';
            $params = "importaciones.id_marca AS ClienteResult,importaciones_desglose_cargas.*,
        iuc.imei AS imeiUC, iuc.status AS statusUC, iuc.id_producto AS idProductoUC,
        iuchom.imei AS imeiUCH, iuchom.id_distribucion, iuchom.created_at AS fechaHomologacion, iuchom.reception_at AS fechaRecepcion, 
        dis.distribucion_name AS distribucionName";
            $paramsLeft = "
        LEFT JOIN importaciones_desglose ON importaciones_desglose.id = importaciones_desglose_cargas.id_importacion
        LEFT JOIN importaciones ON importaciones.id = importaciones_desglose.id_importacion
        LEFT JOIN inventarios_unidades_completas AS iuc ON importaciones_desglose_cargas.imei_meid_1  = iuc.imei 
        LEFT JOIN inventarios_unidades_completas_homologacion AS iuchom ON importaciones_desglose_cargas.imei_meid_1 = iuchom.imei 
        LEFT JOIN distribuciones AS dis ON iuchom.id_distribucion = dis.id";
            if($countValSearch === 15){
                //VALIDACION DE IMEI
                $validateImei = $valU->traerInformacionAjaxDinamic("importaciones_desglose_cargas", $params, $paramsLeft, "importaciones_desglose_cargas.imei_meid_1 ='" . $idSearchFast . "'", null, 1);
                //var_dump($validateImei);
                if (!$validateImei){
                    throw new Exception('Not Valid');
                }
                //VALIDO CLIENTE CON RESULT
                if ($_SESSION["perfil"] == "Cliente"){
                    if ((int)$validateImei["ClienteResult"] !== (int)$_SESSION["clienteRelacion"]){
                        throw new Exception('bad');
                    }
                }

                if (isset($validateImei) && !empty($validateImei) && $countValSearch === 15) {
                    //FECHA DE LA DISTRIBUCION
                    $fechaDistribucion = (isset($validateImei["fechaHomologacion"]) && !empty($validateImei["fechaHomologacion"]))?strftime("%d-%B-%G || %H:%M:%S %p", strtotime($validateImei["fechaHomologacion"])):"dd-mm-aaaa || hh:mm:ss";
                    $nombreDistribucion = (isset($validateImei["distribucionName"]) && !empty($validateImei["distribucionName"]))?$validateImei["distribucionName"]:"S/N";
                    //RECEPCION DE MERCANCIA
                    if(isset($validateImei["statusUC"]) && !empty($validateImei["statusUC"]) && $validateImei["statusUC"] == "2"){
                        $msgRecepcion = '<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
                        <div class="alert alert-success">
                            <h5 class="font-weight-bold my-0"><i class="icon fas fa-check mr-2"></i>¡Mercancía recepcionada!</h5>
                        </div>
                    </div>';
                    } else {
                        if(isset($validateImei["imeiUCH"]) && !empty($validateImei["imeiUCH"])){
                            $msgRecepcion = '<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
                            <div class="alert alert-success">
                                <h5 class="font-weight-bold my-0"><i class="icon fas fa-check mr-2"></i>¡Mercancía recepcionada!</h5>
                            </div>
                        </div>';
                        }
                    }
                    $newCajaMaster = (isset($validateImei["new_master_box"]) && !empty($validateImei["new_master_box"]))?$validateImei["new_master_box"]:"S/N";
                    $newPallet = (isset($validateImei["new_pallet"]) && !empty($validateImei["new_pallet"]))?$validateImei["new_pallet"]:"S/N";
                    $modal = '<div class="row p-0">
                    '.$msgRecepcion.'
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
                        <h4 class="mb-1 font-weight-bold">Información del IMEI<span class="text-muted"> ('.$validateImei["imei_meid_1"].')</span></h4>
                        <hr class="my-2">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-2 text-center">
                        <div class="info-box bg-primary shadow">
                            <span class="info-box-icon"><i class="fas fa-file-alt"></i></span>
                            <div class="info-box-content">
                                <h4 class="mb-1 font-weight-bold">Factura</h4>
                                <small class="my-0">'.$validateImei["fr_ins_no"].'</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-2 text-center">
                        <div class="info-box bg-primary shadow">
                            <span class="info-box-icon"><i class="fas fa-barcode"></i></span>
                            <div class="info-box-content">
                                <h4 class="mb-1 font-weight-bold">IMEI</h4>
                                <small class="my-0">'.$validateImei["imei_meid_1"].'</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-2 text-center">
                        <div class="info-box bg-primary shadow">
                            <span class="info-box-icon"><i class="fas fa-mobile-alt"></i></span>
                            <div class="info-box-content">
                                <h4 class="mb-1 font-weight-bold">Modelo</h4>
                                <small class="my-0">'.$validateImei["model"].'</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-2 text-center">
                        <div class="info-box bg-primary shadow">
                            <span class="info-box-icon"><i class="fas fa-palette"></i></span>
                            <div class="info-box-content">
                                <h4 class="mb-1 font-weight-bold">Color</h4>
                                <small class="my-0">'.$validateImei["color"].'</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-2">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2 text-center">
                                <h5 class="mb-0 font-weight-bold text-muted">Datos de Importación</h5>
                                <small class="my-1 text-muted">'.strftime("%d-%B-%G || %H:%M:%S %p", strtotime($validateImei["created_at"])).'</small>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
                                <label>Importación</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="idImportacionQr" name="idImportacionQr" placeholder="xxxxxxxxxxxx" readonly value="'.$validateImei["folio"].'">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
                                <label>Caja Master</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dolly-flatbed"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="idImportacionQr" name="idImportacionQr" placeholder="xxxxxxxxxxxx" readonly value="'.$validateImei["box_no"].'">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
                                <label>Pallet</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pallet"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="idImportacionQr" name="idImportacionQr" placeholder="xxxxxxxxxxxxxx" readonly value="'.$validateImei["big_box_no"].'">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-2">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2 text-center">
                                <h5 class="mb-0 font-weight-bold text-muted">Datos de Distribución</h5>
                                <small class="my-1 text-muted">'.$fechaDistribucion.'</small>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
                                <label>Distribución</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Nombre de la distribución" readonly value="'.$nombreDistribucion.'">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
                                <label>Caja Master</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dolly-flatbed"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="xxxxxxxxxxxx" readonly value="'.$newCajaMaster.'">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
                                <label>Pallet</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pallet"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="xxxxxxxxxxxxxx" readonly value="'.$newPallet.'">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                    $messages = "¡Búsqueda exitosa!";
                    $val = true;
                }
            }
            else if($countValSearch === 14){
                //VALIDACION DE PALLET
                $validatePallet = $valU->traerInformacionAjaxDinamic("importaciones_desglose_cargas", $params, $paramsLeft, "importaciones_desglose_cargas.big_box_no ='" . $idSearchFast . "'", null, 1);
                //var_dump($validateImei);
                if (!$validatePallet){
                    throw new Exception('Not Valid');
                }
                //VALIDO CLIENTE CON RESULT
                if ($_SESSION["perfil"] == "Cliente"){
                    if ((int)$validatePallet["ClienteResult"] !== (int)$_SESSION["clienteRelacion"]){
                        throw new Exception('bad');
                    }
                }
                if(isset($validatePallet) && !empty($validatePallet) && $countValSearch === 14 && count($validatePallet) != 0){
                    $fechaDistribucion = (isset($validatePallet["fechaHomologacion"]) && !empty($validatePallet["fechaHomologacion"]))?strftime("%d-%B-%G || %H:%M:%S %p", strtotime($validatePallet["fechaHomologacion"])):"dd-mm-aaaa || hh:mm:ss";
                    if(isset($validatePallet["statusUC"]) && !empty($validatePallet["statusUC"]) && $validatePallet["statusUC"] == "2"){
                        $msgRecepcion = '<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
                        <div class="alert alert-success">
                            <h5 class="font-weight-bold my-0"><i class="icon fas fa-check mr-2"></i>¡Mercancía recepcionada!</h5>
                        </div>
                    </div>';
                    } else {
                        if(isset($validatePallet["imeiUCH"]) && !empty($validatePallet["imeiUCH"])){
                            $msgRecepcion = '<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
                            <div class="alert alert-success">
                                <h5 class="font-weight-bold my-0"><i class="icon fas fa-check mr-2"></i>¡Mercancía recepcionada!</h5>
                            </div>
                        </div>';
                        }
                    }
                    $modal = '<div class="row p-0">
                    '.$msgRecepcion.'
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
                        <h4 class="mb-1 font-weight-bold">Información del Pallet<span class="text-muted"> ('.$validatePallet["big_box_no"].')</span></h4>
                        <hr class="my-2">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-2 text-center">
                        <div class="info-box bg-primary shadow">
                            <span class="info-box-icon"><i class="fas fa-shipping-fast"></i></span>
                            <div class="info-box-content">
                                <h4 class="mb-1 font-weight-bold">Importación</h4>
                                <small class="my-0">'.$validatePallet["folio"].'</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-2 text-center">
                        <div class="info-box bg-primary shadow">
                        <span class="info-box-icon"><i class="fas fa-file-alt"></i></span>
                            <div class="info-box-content">
                                <h4 class="mb-1 font-weight-bold">Factura</h4>
                                <small class="my-0">'.$validatePallet["fr_ins_no"].'</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-2 text-center">
                        <div class="info-box bg-primary shadow">
                            <span class="info-box-icon"><i class="fas fa-mobile-alt"></i></span>
                            <div class="info-box-content">
                                <h4 class="mb-1 font-weight-bold">Modelo</h4>
                                <small class="my-0">'.$validatePallet["model"].'</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-2 text-center">
                        <div class="info-box bg-primary shadow">
                            <span class="info-box-icon"><i class="fas fa-palette"></i></span>
                            <div class="info-box-content">
                                <h4 class="mb-1 font-weight-bold">Color</h4>
                                <small class="my-0">'.$validatePallet["color"].'</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-2 text-center">
                        <h5 class="mb-0 font-weight-bold text-muted">Datos de Importación</h5>
                        <small class="my-1 text-muted">'.strftime("%d-%B-%G || %H:%M:%S %p", strtotime($validatePallet["created_at"])).'</small>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-2 text-center">
                        <h5 class="mb-0 font-weight-bold text-muted">Datos de Distribución</h5>
                        <small class="my-1 text-muted">'.$fechaDistribucion.'</small>
                    </div>
                    <div class="col-12 mt-2">
                        <table class="table table-striped table-bordered dt-responsive td_details_caja_master_pallet" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Pallet</th>
                                    <th>Caja Master</th>
                                    <th>IMEIs</th>
                                    <th>¿Homologado?</th>
                                    <th>Distribución</th>
                                    <th>Nueva Caja Master</th>
                                    <th>Nuevo Pallet</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <script>
                            var colums = [
                                { data: "id" },
                                { data: "big_box_no" },
                                { data: "box_no" },
                                { data: "imei" },
                                { data: "status" },
                                { data: "name_distribucion" },
                                { data: "new_pallet" },
                                { data: "new_caja_master" },
                            ];
                            datatablesGenerate($(".td_details_caja_master_pallet"), rutaAjax + "general.ajax.php?typeResearch='.my_encrypt("pallet","TECSOLT").'&infoDetails='.my_encrypt($validatePallet["big_box_no"],"TECSOLT").'", colums);
                        </script>
                    </div>
                </div>';
                    $messages = "¡Búsqueda exitosa!";
                    $val = true;
                }
                else{
                    //VALIDACION DE CAJA MASTER DE 14 DIGITOS
                    $validateCajaMaster = $valU->traerInformacionAjaxDinamic("importaciones_desglose_cargas", $params, $paramsLeft, "importaciones_desglose_cargas.box_no ='" . $idSearchFast . "'", null, 1);
                    if(isset($validateCajaMaster) && !empty($validateCajaMaster) && $countValSearch === 14 && count($validateCajaMaster) != 0){
                        $fechaDistribucion = (isset($validateCajaMaster["fechaHomologacion"]) && !empty($validateCajaMaster["fechaHomologacion"]))?strftime("%d-%B-%G || %H:%M:%S %p", strtotime($validateCajaMaster["fechaHomologacion"])):"dd-mm-aaaa || hh:mm:ss";
                        if(isset($validateCajaMaster["statusUC"]) && !empty($validateCajaMaster["statusUC"]) && $validateCajaMaster["statusUC"] == "2"){
                            $msgRecepcion = '<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
                        <div class="alert alert-success">
                            <h5 class="font-weight-bold my-0"><i class="icon fas fa-check mr-2"></i>¡Mercancía recepcionada!</h5>
                        </div>
                    </div>';
                        } else {
                            if(isset($validateCajaMaster["imeiUCH"]) && !empty($validateCajaMaster["imeiUCH"])){
                                $msgRecepcion = '<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
                            <div class="alert alert-success">
                                <h5 class="font-weight-bold my-0"><i class="icon fas fa-check mr-2"></i>¡Mercancía recepcionada!</h5>
                            </div>
                        </div>';
                            }
                        }
                        $modal = '<div class="row p-0">
                    '.$msgRecepcion.'
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
                        <h4 class="mb-1 font-weight-bold">Información de la Caja Master<span class="text-muted"> ('.$validateCajaMaster["box_no"].')</span></h4>
                        <hr class="my-2">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-2 text-center">
                        <div class="info-box bg-primary shadow">
                            <span class="info-box-icon"><i class="fas fa-shipping-fast"></i></span>
                            <div class="info-box-content">
                                <h4 class="mb-1 font-weight-bold">Importación</h4>
                                <small class="my-0">'.$validateCajaMaster["folio"].'</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-2 text-center">
                        <div class="info-box bg-primary shadow">
                        <span class="info-box-icon"><i class="fas fa-file-alt"></i></span>
                            <div class="info-box-content">
                                <h4 class="mb-1 font-weight-bold">Factura</h4>
                                <small class="my-0">'.$validateCajaMaster["fr_ins_no"].'</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-2 text-center">
                        <div class="info-box bg-primary shadow">
                            <span class="info-box-icon"><i class="fas fa-mobile-alt"></i></span>
                            <div class="info-box-content">
                                <h4 class="mb-1 font-weight-bold">Modelo</h4>
                                <small class="my-0">'.$validateCajaMaster["model"].'</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-2 text-center">
                        <div class="info-box bg-primary shadow">
                            <span class="info-box-icon"><i class="fas fa-palette"></i></span>
                            <div class="info-box-content">
                                <h4 class="mb-1 font-weight-bold">Color</h4>
                                <small class="my-0">'.$validateCajaMaster["color"].'</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-2 text-center">
                        <h5 class="mb-0 font-weight-bold text-muted">Datos de Importación</h5>
                        <small class="my-1 text-muted">'.strftime("%d-%B-%G || %H:%M:%S %p", strtotime($validateCajaMaster["created_at"])).'</small>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-2 text-center">
                        <h5 class="mb-0 font-weight-bold text-muted">Datos de Distribución</h5>
                        <small class="my-1 text-muted">'.$fechaDistribucion.'</small>
                    </div>
                    <div class="col-12 mt-2">
                        <table class="table table-striped table-bordered dt-responsive td_details_caja_master_pallet" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Pallet</th>
                                    <th>Caja Master</th>
                                    <th>IMEIs</th>
                                    <th>¿Homologado?</th>
                                    <th>Distribución</th>
                                    <th>Nueva Caja Master</th>
                                    <th>Nuevo Pallet</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <script>
                            var colums = [
                                { data: "id" },
                                { data: "big_box_no" },
                                { data: "box_no" },
                                { data: "imei" },
                                { data: "status" },
                                { data: "name_distribucion" },
                                { data: "new_pallet" },
                                { data: "new_caja_master" },
                            ];
                            datatablesGenerate($(".td_details_caja_master_pallet"), rutaAjax + "general.ajax.php?typeResearch='.my_encrypt("caja_master","TECSOLT").'&infoDetails='.my_encrypt($validateCajaMaster["box_no"],"TECSOLT").'", colums);
                        </script>
                    </div>
                </div>';
                        $messages = "¡Búsqueda exitosa!";
                        $val = true;
                    }
                }
            }
            else if($countValSearch === 18){
                //VALIDACION DE CAJA MASTER
                $validateCajaMaster = $valU->traerInformacionAjaxDinamic("importaciones_desglose_cargas", $params, $paramsLeft, "importaciones_desglose_cargas.box_no ='" . $idSearchFast . "'", null, 1);
                //var_dump($validateImei);
                if (!$validateCajaMaster){
                    throw new Exception('Not Valid');
                }
                //VALIDO CLIENTE CON RESULT
                if ($_SESSION["perfil"] == "Cliente"){
                    if ((int)$validateCajaMaster["ClienteResult"] !== (int)$_SESSION["clienteRelacion"]){
                        throw new Exception('bad');
                    }
                }
                if(isset($validateCajaMaster) && !empty($validateCajaMaster) && $countValSearch === 18){
                    $fechaDistribucion = (isset($validateCajaMaster["fechaHomologacion"]) && !empty($validateCajaMaster["fechaHomologacion"]))?strftime("%d-%B-%G || %H:%M:%S %p", strtotime($validateCajaMaster["fechaHomologacion"])):"dd-mm-aaaa || hh:mm:ss";
                    if(isset($validateCajaMaster["statusUC"]) && !empty($validateCajaMaster["statusUC"]) && $validateCajaMaster["statusUC"] == "2"){
                        $msgRecepcion = '<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
                        <div class="alert alert-success">
                            <h5 class="font-weight-bold my-0"><i class="icon fas fa-check mr-2"></i>¡Mercancía recepcionada!</h5>
                        </div>
                    </div>';
                    } else {
                        if(isset($validateCajaMaster["imeiUCH"]) && !empty($validateCajaMaster["imeiUCH"])){
                            $msgRecepcion = '<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
                            <div class="alert alert-success">
                                <h5 class="font-weight-bold my-0"><i class="icon fas fa-check mr-2"></i>¡Mercancía recepcionada!</h5>
                            </div>
                        </div>';
                        }
                    }
                    $modal = '<div class="row p-0">
                    '.$msgRecepcion.'
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
                        <h4 class="mb-1 font-weight-bold">Información de la Caja Master<span class="text-muted"> ('.$validateCajaMaster["box_no"].')</span></h4>
                        <hr class="my-2">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-2 text-center">
                        <div class="info-box bg-primary shadow">
                            <span class="info-box-icon"><i class="fas fa-shipping-fast"></i></span>
                            <div class="info-box-content">
                                <h4 class="mb-1 font-weight-bold">Importación</h4>
                                <small class="my-0">'.$validateCajaMaster["folio"].'</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-2 text-center">
                        <div class="info-box bg-primary shadow">
                        <span class="info-box-icon"><i class="fas fa-file-alt"></i></span>
                            <div class="info-box-content">
                                <h4 class="mb-1 font-weight-bold">Factura</h4>
                                <small class="my-0">'.$validateCajaMaster["fr_ins_no"].'</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-2 text-center">
                        <div class="info-box bg-primary shadow">
                            <span class="info-box-icon"><i class="fas fa-mobile-alt"></i></span>
                            <div class="info-box-content">
                                <h4 class="mb-1 font-weight-bold">Modelo</h4>
                                <small class="my-0">'.$validateCajaMaster["model"].'</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 mb-2 text-center">
                        <div class="info-box bg-primary shadow">
                            <span class="info-box-icon"><i class="fas fa-palette"></i></span>
                            <div class="info-box-content">
                                <h4 class="mb-1 font-weight-bold">Color</h4>
                                <small class="my-0">'.$validateCajaMaster["color"].'</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-2 text-center">
                        <h5 class="mb-0 font-weight-bold text-muted">Datos de Importación</h5>
                        <small class="my-1 text-muted">'.strftime("%d-%B-%G || %H:%M:%S %p", strtotime($validateCajaMaster["created_at"])).'</small>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-2 text-center">
                        <h5 class="mb-0 font-weight-bold text-muted">Datos de Distribución</h5>
                        <small class="my-1 text-muted">'.$fechaDistribucion.'</small>
                    </div>
                    <div class="col-12 mt-2">
                        <table class="table table-striped table-bordered dt-responsive td_details_caja_master_pallet" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Pallet</th>
                                    <th>Caja Master</th>
                                    <th>IMEIs</th>
                                    <th>¿Homologado?</th>
                                    <th>Distribución</th>
                                    <th>Nueva Caja Master</th>
                                    <th>Nuevo Pallet</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <script>
                            var colums = [
                                { data: "id" },
                                { data: "big_box_no" },
                                { data: "box_no" },
                                { data: "imei" },
                                { data: "status" },
                                { data: "name_distribucion" },
                                { data: "new_pallet" },
                                { data: "new_caja_master" },
                            ];
                            datatablesGenerate($(".td_details_caja_master_pallet"), rutaAjax + "general.ajax.php?typeResearch='.my_encrypt("caja_master","TECSOLT").'&infoDetails='.my_encrypt($validateCajaMaster["box_no"],"TECSOLT").'", colums);
                        </script>
                    </div>
                </div>';
                    $messages = "¡Búsqueda exitosa!";
                    $val = true;
                }
            }
            else{
                throw new Exception('bad digits');
            }
            $datosSend = array(
                "status" => $val,
                "message" => $messages,
                "data" => $modal
            );

            echo json_encode($datosSend, JSON_HEX_QUOT | JSON_HEX_TAG);
        } catch (Exception $e) {
            //echo $e;
            //do method two
            $datosSend = array(
                "status" => $val,
                "message" => $messages,
                "data" => $modal
            );

            echo json_encode($datosSend, JSON_HEX_QUOT | JSON_HEX_TAG);
        }
    }

    public function ajaxShowTypesReport()
    {
        $valU = new AlmacenesController();
        $typeReport = my_decrypt($this->typeReport,"TECSOLT");
        /*=============================================
        VALIDAMOS EL TIPO DE REPORTE
        =============================================*/
        if($typeReport === "importacion"){
            //TRAEMOS TODAS LAS MARCAS
            $getMarcas = $valU->traerInformacionAjaxDinamic("marcas", "id,nombre_marca", null, "1", 1, 1);
            $title = '<i class="fas fa-cabinet-filing mr-2"></i>Reportes de Importación';
            $modal = '<div class="alert bg-olive">
                    <h5><i class="icon fas fa-info-circle"></i> Recuerda:</h5>
                    <p class="mb-1">En este apartado podrás visualizar los reportes disponibles para el área de importación</p>
                </div>
                <div class="row">
                    <!-- APARTADO DE REPORTES -->
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div id="accordionReportesImportacion">
                            <!-- REPORTES DE IMPORTACION 1 -->
                            <div class="card bg-white">
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseReport1" aria-expanded="false"><i class="fas fa-folder-plus mr-2"></i>Reporte de Inventario</a>
                                    </h4>
                                </div>
                                <div id="collapseReport1" class="collapse" data-parent="#accordionReportesImportacion">
                                    <div class="card-body">
                                        <!-- REPORTES DE IMPORTACION 1 -->
                                        <form target="_blank" role="form" method="post" enctype="multipart/form-data" class="formGeneral reportImportacion" action="'.RUTA.'data/dataProcess.php?typeReport=importacion&re=1">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <label class="control-label">Fecha Inicial'.REQUIRED.'</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control" name="fechaInicial" id="fechaInicial" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <label class="control-label">Fecha Final'.REQUIRED.'</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control" name="fechaFinal" id="fechaFinal" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
                                                    <label class="control-label">Marca'.REQUIRED.'</label>
                                                    <div class="input-group">
                                                        <select class="form-control input-lg select2" id="idBrand" name="idBrand" style="width: 100%;" required>
                                                            <option value="">Elija una opción...</option>
                                                            <option value="all"> - Todas las marcas</option>';
                                                            foreach ($getMarcas as $key => $value){
                                                                $modal .='<option value='.$value["id"].'> - '.$value["nombre_marca"].'</option>';
                                                            }
                                                        $modal .='</select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-2">
                                                    <button class="btn btn-primary w-100 shadow-sm"><i class="fas fa-file-download mr-2"></i>Descargar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
            $status = true;
        } else {
            $title = '<i class="far fa-file mr-2"></i>Aún NO existen reportes';
            $modal = '<!-- APARTADO DE REPORTES -->
                <div class="row d-flex align-items-center h-100">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
                        <h5 class="font-weight-bold text-muted mb-1">¡Disculpa las molestias!</h5>
                        <p class="text-muted mb-3">Aún no se han creado reportes para este módulo</p>
                        <img src="'.RUTA.'/public/img/empty.gif" class="m-auto d-block" style="width:30%;">
                    </div>
                </div>';
            $status = false;
        }
        $modal .= '<script>$(".select2").select2();</script>';

        $datosSend = array(
            "status" => $status,
            "title" => $title,
            "data" => $modal
        );

        echo json_encode($datosSend, JSON_HEX_QUOT | JSON_HEX_TAG);
    }

    public function ajaxShowTypesRequestTraffic()
    {
        $valU = new AlmacenesController();
        $typeRequest = my_decrypt($this->typeRequest,"TECSOLT");
        $typeTransport = $this->typeTransport;
        /*=============================================
        VALIDAMOS EL TIPO DE REPORTE
        =============================================*/
        if(trim($typeRequest) === "importacion" && (trim($typeTransport) === "1" || trim($typeTransport) === "2")) {
            //GET CLIENTES
            $clientes = $valU->traerInformacionAjaxDinamic("clientes", null, null, "estado = 1", 1, 1);
            //GET PALLETS
            $num_pallets = $valU->traerInformacionAjaxDinamic("num_pallets", null, null, "status = 1", 1, 1);
            //GET ORIGENES
            $origen = $valU->traerInformacionAjaxDinamic("origenes", null, null, "status = 1", 1, 1);
            //GET DESTINOS
            $destino = $valU->traerInformacionAjaxDinamic("destinos", null, null, "status = 1", 1, 1);
            //DATOS GENERAL
            $modal = '
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                <div class="row">
                    <!-- DATOS DE LA SOLICITUD -->
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="row">
                            <!-- CLIENTE -->
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
                                <label>Cliente'.REQUIRED.'</label>
                                <div class="input-group">
                                    <select id="nuevoNombre" name="nuevoNombreCliente" class="form-control select2 selectRegionDependence" style="width: 100%;" required>
                                        <option value="">Elija una opción...</option>';
                                        foreach ($clientes as $value){
                                            // var_dump($value);
                                            $nombreCliente = (isset($value["alias"]) && !empty($value["alias"]))?$value["alias"]:$value["razon_social"];
                                            $modal .= '<option value="'.$value["id"].'"> - '.$nombreCliente.'</option>';
                                        }
                                    $modal .= '</select>
                                </div>
                            </div>
                            <!-- ORIGEN -->
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
                                <label>Origen'.REQUIRED.'</label>
                                <div class="input-group">
                                    <select id="detalleOrigen" name="detalleOrigen" class="form-control select2 detalleOrigen" style="width: 100%;" placeholder="Selecciona un origen" required>
                                        <option value="">Elija una opción...</option>';
                                        foreach ($origen as $key => $value){
                                            $modal .= '<option value="'.$value["id"].'"> - '.$value["descripcion"].'</option>';
                                        }
                                    $modal .= '</select>
                                </div>
                            </div>
                            <!-- DESTINO -->
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
                                <label>Destino'.REQUIRED.'</label>
                                <div class="input-group">
                                    <select id="detalleDestino" name="detalleDestino" class="form-control select2" style="width: 100%;" placeholder="Selecciona un destino" required>
                                        <option value="">Elija una opción...</option>';
                                        foreach ($destino as $key => $value){
                                            $modal .= '<option value="'.$value["id"].'"> - '.$value["descripcion"].'</option>';
                                        }
                                    $modal .= '</select>
                                </div>
                            </div>
                            <!-- FECHA DE RECOLECCION -->
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
                                <label>Fecha de Despacho'.REQUIRED.'</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" name="fechaRecoleccion" id="fechaRecoleccion" min="'.date('Y-m-d').'" value="" required>
                                </div>
                            </div>
                            <!-- HORA DE RECOLECCION -->
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
                                <label>Hora de Despacho'.REQUIRED.'</label>
                                <!--<div class="input-group">
                                    <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                                        <input type="text" class="form-control" name="horaRecoleccion" id="horaRecoleccion" placeholder="Selecciona una hora" value="" required>
                                        <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div>-->
                                <div class="input-group">
                                    <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                                        <input type="text" placeholder="Selecciona una hora" name="horaRecoleccion" id="horaRecoleccion" class="form-control datetimepicker-input" data-target="#datetimepicker3" required/>
                                        <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- FECHA DE RECOLECCION -->
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
                                <label>Fecha de Solicitud'.REQUIRED.'</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" name="fechaDocumento" id="fechaDocumento" value="'.date('Y-m-d').'" required readonly>
                                </div>
                            </div>
                            <!-- NUM PALLETS -->
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3 palletsHtml">
                                <label>Num Pallets(s)'.REQUIRED.'</label>
                                <!-- <div class="input-group d-none">
                                        <select id="num_pallets" name="num_pallets" class="form-control select2" style="width: 100%;" required>
                                            <option value="">Elija una opción...</option>';
                                //          foreach ($num_pallets as $key => $value){
                                //             $modal .= '<option value="'.$value["id"].'"> - '.$value["numero"].' PALLETS</option>"';
                                //          }
                                $modal .= '</select>
                                </div> -->
                                <div class="input-group">
                                    <input type="text" class="form-control" id="noTotalPallet" name="noTotalPallet" placeholder="Número total de pallet(s)" readonly>
                                </div>
                            </div>';
                            // //TRANSPORTISTA
                            // if(trim($typeTransport) === "1"){
                            //     $modal .= '<!-- BLINDAJE -->
                            //     <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 blindajeHtml">
                            //         <label>Tipo de Blindaje'.REQUIRED.'</label>
                            //         <select class="form-control select2" id="tipoBlindaje" name="tipoBlindaje" style="width:100%;">
                            //             <option value="">Elija una opción...</option>';
                            //             foreach (TIPO_BLINDAJE as $item => $valueTipo) {
                            //                 if ($valueTipo["status"] == 1 || $valueTipo["status"] == "1") {
                            //                     $modal .= '<option value="' . $valueTipo["id"] . '">' . $valueTipo["texto"] . '</option>';
                            //                 }
                            //             }
                            //         $modal .= '</select>
                            //     </div>';
                            // }
                            // //CUSTODIA
                            // else if(trim($typeTransport) === "2") {
                            //     $modal .= '<!-- ARMA -->
                            //     <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 armaHtml">
                            //         <label>Arma'.REQUIRED.'</label>
                            //         <select class="form-control select2" id="armaTrans" name="armaTrans" style="width:100%;">
                            //             <option value="">Elija una opción...</option>';
                            //             foreach (ARMA as $item => $valueArma) {
                            //                 if ($valueArma["status"] == 1 || $valueArma["status"] == "1") {
                            //                     $modal .= '<option value="' . $valueArma["id"] . '">' . $valueArma["texto"] . '</option>';
                            //                 }
                            //             }
                            //         $modal .= '</select>
                            //     </div>';
                            // }
                            $modal .= '<script>
                                $(".select2").select2();
                                $("#datetimepicker3").datetimepicker({
                                    format: \'LT\',
                                    autoclose: true,
                                });
                            </script>
                        </div>
                    </div>
                    <!-- DATOS DEL TRANSPORTE -->
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="jumbotron pt-3">
                            <form role="form" method="post" enctype="multipart/form-data" class="formListTrans">
                                <div class="row">
                                    <!-- INSTRUCCIONES -->
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <h2 class="font-weight-bold text-muted"><i class="fas fa-truck mr-2"></i>Datos Transporte</h2>
                                        <small class="text-muted"><i>En este apartado debes de agregar el número de transportes con sus pallets,
                                        en caso de que requieras custodia podrás agregar en la parte inferior.</i></small>
                                        <hr class="my-3">
                                    </div>
                                    <!-- AGREGAR CUSTODIA -->
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                                        <p class="mb-1">¿Necesitas blindaje para esta solicitud?</p>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="custodiaSolicitud" id="optionRadio1" value="SI" checked>
                                            <label class="form-check-label" for="optionRadio1">SI</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="custodiaSolicitud" id="optionRadio2" value="NO">
                                            <label class="form-check-label" for="optionRadio2">NO</label>
                                        </div>
                                    </div>
                                    <!-- AGREGAR TRANSPORTE -->
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                                        <form role="form" method="post" enctype="multipart/form-data" class="formListTrans">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1 d-flex justify-content-center align-items-center align-self-center px-0">
                                                    <p class="font-weight-bold mb-0">#</p>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-5 col-xl-5">
                                                    <select id="numPalletsSolTrans" name="numPalletsSolTrans" class="form-control select2" style="width: 100%;">
                                                        <option value="">Elija una opción...</option>';
                                                        foreach ($num_pallets as $key => $value){
                                                            $modal .= '<option value="'.my_encrypt($value["id"],"TECSOLT").'"> - '.$value["numero"].' PALLETS</option>"';
                                                        }
                                                    $modal .= '</select>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-5 col-xl-5">
                                                    <select id="custodiaSolTrans" name="custodiaSolTrans" class="form-control" style="width: 100%;">
                                                        <option value="">Elija una opción...</option>';
                                                        foreach (TIPO_BLINDAJE as $item => $valueTipo) {
                                                            if ($valueTipo["status"] == 1 || $valueTipo["status"] == "1") {
                                                                $modal .= '<option value="'.my_encrypt($valueTipo["id"],"TECSOLT").'"> - ' . $valueTipo["texto"] . '</option>';
                                                            }
                                                        }
                                                    $modal .= '</select>
                                                    <input type="hidden" name="statusBlindaje" id="statusBlindaje" value="true">
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1 d-flex justify-content-center align-items-center align-self-center">
                                                    <button type="submit" class="btn btn-primary addNewTransList"><i class="iconNewTrans fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- LISTA DE TRANSPORTES -->
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-4">
                                        <div class="table_list_trans"></div>
                                        <script>validaListaTransportes();</script>
                                    </div>
                                    <!-- ACCIONES DEL TRANSPORTE -->
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <button type="button" class="btn btn-danger d-block w-100 btnCleanListTrans"><i class="fas fa-trash-alt mr-2"></i>Limpiar Lista</button>
                                    </div>
                                    <script>
                                        /*=============================================
                                        AGREGAR TRANSPORTE A LA LISTA DE PEDIDO
                                        =============================================*/
                                        $(".formListTrans").submit(function(e) {
                                            e.preventDefault();
                                            let formularioParams = $(this).serializeArray(),
                                                swalAwait,
                                                datos = new FormData();
                                            //VALORES DEL FORMULARIO
                                            if($.trim(formularioParams[1]["value"]) == "" && $.trim(formularioParams[2]["value"]) == ""){
                                                toastSweetalert(null, "error", "¡Debes agregar los valores del pallet y el tipo de blindaje!", 6000);
                                                return;
                                            }
                                            datos.append("dataNewRowList", JSON.stringify(formularioParams));
                                            datos.append("typeMovList", "addTrans");

                                            $.ajax({
                                                url: ruta + "public/ajax/transportes.ajax.php",
                                                method: "POST",
                                                data: datos,
                                                cache: false,
                                                dataType: "json",
                                                contentType: false,
                                                processData: false,
                                                beforeSend: function() {
                                                    $(document).find(".addNewTransList").children(".iconNewTrans").removeClass("fa-plus");
                                                    $(document).find(".addNewTransList").children(".iconNewTrans").addClass("fa-spinner fa-spin");
                                                    $(document).find(".addNewTransList").attr("disabled",true);
                                                },
                                                success: function(respuesta) {
                                                    $(document).find(".addNewTransList").children(".iconNewTrans").removeClass("fa-spinner fa-spin");
                                                    $(document).find(".addNewTransList").children(".iconNewTrans").addClass("fa-plus");
                                                    $(document).find(".addNewTransList").removeAttr("disabled");
                                                    validaListaTransportes();
                                                    if (respuesta.success) {
                                                        toastSweetalert(null, "success", respuesta.message, respuesta.timer);
                                                    } else {
                                                        toastSweetalert(null, "error", respuesta.message, respuesta.timer);
                                                    }
                                                },
                                                error: function(xhr, status) {
                                                    $(document).find(".addNewTransList").children(".iconNewTrans").removeClass("fa-spinner fa-spin");
                                                    $(document).find(".addNewTransList").children(".iconNewTrans").addClass("fa-plus");
                                                    $(document).find(".addNewTransList").removeAttr("disabled");
                                                    //
                                                    datos.append("xhr", JSON.stringify(xhr));
                                                    datos.append("status", status);
                                                    let resultadoAjax = peticionAjax(ruta + "public/ajax/general.ajax.php", "POST", datos, "json");
                                                    let msgError = ($.trim(resultadoAjax.messages) != "") ? resultadoAjax.messages : "¡Disculpa las molestias, pero hubo un error en el proceso, ya se notificó al equipo de TECSOLT!";
                                                    Swal.fire({
                                                        icon: "error",
                                                        title: "Ocurrio un problema",
                                                        text: msgError,
                                                        allowOutsideClick: false,
                                                        allowEscapeKey: false,
                                                        showCancelButton: false,
                                                        confirmButtonColor: "#2651be",
                                                        confirmButtonText: "Entendido"
                                                    });
                                                }
                                            });
                                        });
                                    </script>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <div>';
            $status = true;
        } else if(trim($typeRequest) === "distribucion" && (trim($typeTransport) === "1" || trim($typeTransport) === "2")){
            //GET SUBCLIENTES
            $subClientes = $valU->traerInformacionAjaxDinamic("subclientes", null, null, "status = 1", 1, 1);
            //GET PALLETS
            $num_pallets = $valU->traerInformacionAjaxDinamic("num_pallets", null, null, "status = 1", 1, 1);
            //GET ORIGENES
            $origen = $valU->traerInformacionAjaxDinamic("origenes", null, null, "status = 1", 1, 1);
            //GET DESTINOS
            $destino = $valU->traerInformacionAjaxDinamic("destinos", null, null, "status = 1", 1, 1);
            //DATOS GENERAL
            $modal = '<!-- CLIENTE -->
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
                <label>Cliente'.REQUIRED.'</label>
                <div class="input-group">
                    <select id="nuevoNombre" name="nuevoNombreCliente" class="form-control select2 selectRegionDependence" style="width: 100%;" required>
                        <option value="">Elija una opción...</option>';
                        foreach ($subClientes as $value){
                            // var_dump($value);
                            $modal .= '<option value="'.$value["id"].'"> - '.$value["nombre"].'</option>';
                        }
                    $modal .= '</select>
                </div>
            </div>
            <!-- ORIGEN -->
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
                <label>Origen'.REQUIRED.'</label>
                <div class="input-group">
                    <select id="detalleOrigen" name="detalleOrigen" class="form-control select2 detalleOrigen" style="width: 100%;" placeholder="Selecciona un origen" required>
                        <option value="">Elija una opción...</option>';
                        foreach ($origen as $key => $value){
                            $modal .= '<option value="'.$value["id"].'"> - '.$value["descripcion"].'</option>';
                        }
                    $modal .= '</select>
                </div>
            </div>
            <!-- DESTINO -->
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
                <label>Destino'.REQUIRED.'</label>
                <div class="input-group">
                    <select id="detalleDestino" name="detalleDestino" class="form-control select2 detalleDestino" style="width: 100%;" placeholder="Selecciona un destino" required>
                        <option value="">Elija un cliente...</option>
                    </select>
                </div>
            </div>
            <!-- REGION -->
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
                <label>Región'.REQUIRED.'</label>
                <div class="input-group">
                    <select id="detalleRegion" name="detalleRegion" class="form-control detalleRegion" style="width: 100%;" placeholder="Seleccione una región" required readonly>
                        <option value="">Elija una destino...</option>
                    </select>
                </div>
            </div>
            <!-- FECHA DE RECOLECCION -->
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
                <label>Fecha de Despacho'.REQUIRED.'</label>
                <div class="input-group">
                    <input type="date" class="form-control" name="fechaRecoleccion" id="fechaRecoleccion" value="" required>
                </div>
            </div>
            <!-- HORA DE RECOLECCION -->
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
                <label>Hora de Despacho'.REQUIRED.'</label>
                <div class="input-group">
                    <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                        <input type="text" placeholder="Selecciona una hora" name="horaRecoleccion" id="horaRecoleccion" class="form-control datetimepicker-input" data-target="#datetimepicker3" required/>
                        <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fas fa-clock"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FECHA DE RECOLECCION -->
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
                <label>Fecha de Solicitud'.REQUIRED.'</label>
                <div class="input-group">
                    <input type="date" class="form-control" name="fechaDocumento" id="fechaDocumento" value="'.date('Y-m-d').'" required readonly>
                </div>
            </div>
            <!-- NUM PALLETS -->
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3 palletsHtml">
                <label>Num Pallets(s)'.REQUIRED.'</label>
                <div class="input-group">
                    <select id="num_pallets" name="num_pallets" class="form-control select2" style="width: 100%;" required>
                        <option value="">Elija una opción...</option>';
                        foreach ($num_pallets as $key => $value){
                            $modal .= '<option value="'.$value["id"].'"> - '.$value["numero"].' PALLETS</option>"';
                        }
                    $modal .= '</select>
                </div>
            </div>';
            //TRANSPORTISTA
            if(trim($typeTransport) === "1"){
                $modal .= '<!-- BLINDAJE -->
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 blindajeHtml">
                    <label>Tipo de Blindaje'.REQUIRED.'</label>
                    <select class="form-control select2" id="tipoBlindaje" name="tipoBlindaje" style="width:100%;">
                        <option value="">Elija una opción...</option>';
                        foreach (TIPO_BLINDAJE as $item => $valueTipo) {
                            if ($valueTipo["status"] == 1 || $valueTipo["status"] == "1") {
                                $modal .= '<option value="' . $valueTipo["id"] . '">' . $valueTipo["texto"] . '</option>';
                            }
                        }
                    $modal .= '</select>
                </div>';
            }
            //CUSTODIA
            else if(trim($typeTransport) === "2") {
                $modal .= '<!-- ARMA -->
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 armaHtml">
                    <label>Arma'.REQUIRED.'</label>
                    <select class="form-control select2" id="armaTrans" name="armaTrans" style="width:100%;">
                        <option value="">Elija una opción...</option>';
                        foreach (ARMA as $item => $valueArma) {
                            if ($valueArma["status"] == 1 || $valueArma["status"] == "1") {
                                $modal .= '<option value="' . $valueArma["id"] . '">' . $valueArma["texto"] . '</option>';
                            }
                        }
                    $modal .= '</select>
                </div>';
            }
            $modal .= '<script>
                $(".select2").select2();
                $(".detalleDestino").select2();
                $("#datetimepicker3").datetimepicker({
                    format: \'LT\',
                    autoclose: true,
                });
            </script>';
            $status = true;
        } else {
            $modal = '';
            $status = false;
        }

        $datosSend = array(
            "status" => $status,
            "data" => $modal
        );

        echo json_encode($datosSend, JSON_HEX_QUOT | JSON_HEX_TAG);
    }
}
/*=============================================
MENSAJES DE PETICIONES AJAX
=============================================*/
if (isset($_POST["xhr"]) && !empty($_POST["xhr"]) &&
isset($_POST["status"]) && !empty($_POST["status"])) {
    $peticiones = new registroPeticionesAjax();
    $peticiones->xhr = $_POST["xhr"];
    $peticiones->status = $_POST["status"];
    $peticiones->ajaxDeleteSubcliente();
}
/*=============================================
BUSQUEDA RAPIDA DE IMEI, CAJA MASTER Y PALLET
=============================================*/
if (isset($_POST["idSearchFast"]) && !empty($_POST["idSearchFast"])) {
    $peticiones = new registroPeticionesAjax();
    $peticiones->idSearchFast = $_POST["idSearchFast"];
    $peticiones->ajaxSearchFast();
}
/*=============================================
BUSQUEDA RAPIDA DE IMEI, CAJA MASTER Y PALLET
=============================================*/
if (isset($_GET["typeResearch"]) && !empty($_GET["typeResearch"]) &&
isset($_GET["infoDetails"]) && !empty($_GET["infoDetails"])) {
    $peticiones = new registroPeticionesAjax();
    $peticiones->typeResearch = $_GET["typeResearch"];
    $peticiones->infoDetails = $_GET["infoDetails"];
    $peticiones->ajaxShowInfoInvoice();
}
/*=============================================
CERRAR SESSION
=============================================*/
if (isset($_POST["lockSession"]) && !empty($_POST["lockSession"])) {
    $peticiones = new registroPeticionesAjax();
    $peticiones->lockSession = $_POST["lockSession"];
    $peticiones->ajaxLockSession();
}
/*=============================================
MOSTRAR EL TIPO DE REPORTE
=============================================*/
if (isset($_POST["typeReport"]) && !empty($_POST["typeReport"])) {
    $peticiones = new registroPeticionesAjax();
    $peticiones->typeReport = $_POST["typeReport"];
    $peticiones->ajaxShowTypesReport();
}
/*=============================================
TIPO DE SOLICITUD DE TRANSPORTE
=============================================*/
if (isset($_POST["typeRequest"]) && !empty($_POST["typeRequest"]) &&
isset($_POST["typeTransport"]) && !empty($_POST["typeTransport"])) {
    $peticiones = new registroPeticionesAjax();
    $peticiones->typeRequest = $_POST["typeRequest"];
    $peticiones->typeTransport = $_POST["typeTransport"];
    $peticiones->ajaxShowTypesRequestTraffic();
}