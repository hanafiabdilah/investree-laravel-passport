<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZGQ4NWViYWU5Y2YwNjRhMTljNmY2YjFhNjAxYTc2ZjBiNzExMDNjZmUyYTNlYjNlZmFjYTVmM2U3N2YzZWFjZWVmMGRlMjFjMzhiNTc1MTAiLCJpYXQiOjE2NjI2MDQzMzAuMTQxNDUxLCJuYmYiOjE2NjI2MDQzMzAuMTQxNDU1LCJleHAiOjE2OTQxNDAzMjkuODcwNzI0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.PsOtqMDXmjiy692r51Y5szHc7QVEpG66qL3aEnFSL3MeMmcAH4Q60pYqyknAiG8n0KRkTk9Oph7WJcxCigjqCz3anJHKUWuT94TN0dPLBdoeYun9y764bQ49L7p4Sxx9fuD7M3FdTqkylAZ9FPhPu3ew6Uv3q121UkFVKHYBcYysC0juQH4zaFRVKEEdcUhD3TWeJFTxRPRMxaAIoBDCfK6eYZE11uCndxotTQ9L_9g8ux6gh322n8goykdHyZ__gAC7tl76YUBWP7TQR6fp0gaKy6nmw_hjLgMVhGKYJtuks9uH1pFN6KjFRXQdnOaIl9dDL-fWASRLJa1HKctDfzRdMWowuRXkER0pCOGQh7jhR69NCLmHIDHS4uqDG3f0Qc3Ylo8f0aUpSZ71pg-4_noiDJFpkGAqiYaMlfHfjzgven0w0XGlU9aCzCjl6_vO_bbbst4vd0AWFe1GvwHmGs092ua9jh_1eiOEXkV2ZXuqWQjWZE_OS3GpzWDUQBS8ju1AwV7yRHIMGFo6d-n9yu7uEgzmvLAD-CZggOkvURU3h3C0e9RinnzssjC_kYsMASkc2fbkYodWYScryVem1fIy3ToPO-yPcBhyZCnfrdkoKA0BTDeeiVrDdePkpoSArWQUd6yhv3ftNtPKvv5_9XwkQUJBR97w22nzC2YYGsc';
}
