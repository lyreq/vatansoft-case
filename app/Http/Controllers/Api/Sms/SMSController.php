<?php

namespace App\Http\Controllers\Api\Sms;

use App\Facades\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Sms\SendSmsRequest;
use App\Models\Sms;
use App\Services\SmsService;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="SMS",
 *     description="SMS operations"
 * )
 */
class SMSController extends Controller
{

    /**
     * @OA\Info(
     *      title="API Dokümantasyonu",
     *      version="1.0.0",
     *      description="VatanSoft Case Swagger",
     *      @OA\Contact(
     *          email="yasin@yasintimur.com"
     *      )
     * )
     */

    public $smsService;
    function __construct()
    {
        $this->smsService = new SmsService();
    }

    /**
     * @OA\Post(
     *     path="/api/sms/send",
     *     tags={"SMS"},
     *     summary="Send an SMS",
     *     operationId="sendSMS",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/SendSmsRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="SMS sent successfully"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *     )
     * )
     */
    /**
     * @OA\Schema(
     *     schema="SendSmsRequest",
     *     type="object",
     *     required={"number", "message"},
     *     @OA\Property(
     *         property="number",
     *         type="string",
     *         description="Alıcının telefon numarası"
     *     ),
     *     @OA\Property(
     *         property="message",
     *         type="string",
     *         description="Gönderilecek mesaj"
     *     )
     * )
     */

    public function sendSMS(SendSmsRequest $request)
    {
        $smsData = $request->validated();
        $sendSMS = $this->smsService->sendSMS($smsData);

        return Response::success("");
    }

    /**
     * @OA\Get(
     *     path="/api/sms/{sms}",
     *     summary="Belirli bir SMS raporunu getirir",
     *     tags={"SMS"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="sms",
     *         in="path",
     *         required=true,
     *         description="SMS ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="SMS raporu",
     *         @OA\JsonContent(ref="#/components/schemas/SmsDetail")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="SMS bulunamadı"
     *     )
     * )
     */
    /**
     * @OA\Schema(
     *     schema="SmsDetail",
     *     type="object",
     *     title="SMS Detail",
     *     description="Detaylı SMS bilgisi",
     *     @OA\Property(
     *         property="id",
     *         type="integer",
     *         description="SMS ID"
     *     ),
     *     @OA\Property(
     *         property="user_id",
     *         type="integer",
     *         description="Kullanıcı ID"
     *     ),
     *     @OA\Property(
     *         property="number",
     *         type="string",
     *         description="Alıcının telefon numarası"
     *     ),
     *     @OA\Property(
     *         property="message",
     *         type="string",
     *         description="Gönderilen mesaj"
     *     ),
     *     @OA\Property(
     *         property="send_time",
     *         type="string",
     *         format="date-time",
     *         description="Gönderim zamanı"
     *     ),
     * )
     */
    public function show($sms)
    {
        $data = $this->smsService->getById($sms);
        return Response::success("", $data);
    }

    /**
     * @OA\Get(
     *     path="/api/sms",
     *     summary="Tüm SMS raporlarını getirir",
     *     tags={"SMS"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="SMS raporları listesi",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/SmsDetail"))
     *     )
     * )
     */
    /**
     * @OA\Get(
     *     path="/api/sms",
     *     summary="SMS raporlarını listeler",
     *     tags={"SMS"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="send_time",
     *         in="query",
     *         required=false,
     *         description="Bu tarihten önce gönderilen SMS'ler listelenir (zorunlu değil)",
     *         @OA\Schema(
     *             type="string",
     *             format="date-time"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="SMS listesi başarıyla döndürüldü",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/SmsDetail")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Geçersiz istek"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Yetkisiz erişim"
     *     )
     * )
     */
    public function index(Request $request)
    {
        $filter = $request->only(['send_time']);
        $smsList = $this->smsService->listSMS($filter);

        return Response::success("", $smsList);
    }
}
