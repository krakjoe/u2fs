--TEST--
u2fs\registration\verify U2FS_CHALLENGE_ERROR
--SKIPIF--
<?php if (!extension_loaded("u2fs")) print "skip"; ?>
--FILE--
<?php 
u2fs\setAppId("http://demo.yubico.com");
u2fs\setOrigin("http://demo.yubico.com");
u2fs\setChallenge("0000000000000000000000000000000000000000000");

$response = <<<EOD
{
	"registrationData": "BQRcbdE4PHGRaJUTK9hY4GrX_jZa5eWgjJK6IfwezrndHvQi7QQtYA2qAg4NrebNkSCoOwJ0V1PzLlP1Wr_Oku_0QKfeNR0Ei4_I40GCo5xjm4Q7hnZwzXQ5f5vjtnx7xIqCZ-z7GOGExeouBXxaMgleYpX7xMR6Y9wa_qzLLTAr6IcwggIbMIIBBaADAgECAgR1o_Z1MAsGCSqGSIb3DQEBCzAuMSwwKgYDVQQDEyNZdWJpY28gVTJGIFJvb3QgQ0EgU2VyaWFsIDQ1NzIwMDYzMTAgFw0xNDA4MDEwMDAwMDBaGA8yMDUwMDkwNDAwMDAwMFowKjEoMCYGA1UEAwwfWXViaWNvIFUyRiBFRSBTZXJpYWwgMTk3MzY3OTczMzBZMBMGByqGSM49AgEGCCqGSM49AwEHA0IABBmjfkNqa2mXzVh2ZxuES5coCvvENxDMDLmfd-0ACG0Fu7wR4ZTjKd9KAuidySpfona5csGmlM0Te_Zu35h_wwujEjAQMA4GCisGAQQBgsQKAQIEADALBgkqhkiG9w0BAQsDggEBAb0tuI0-CzSxBg4cAlyD6UyT4cKyJZGVhWdtPgj_mWepT3Tu9jXtdgA5F3jfZtTc2eGxuS-PPvqRAkZd40AXgM8A0YaXPwlT4s0RUTY9Y8aAQzQZeAHuZk3lKKd_LUCg5077dzdt90lC5eVTEduj6cOnHEqnOr2Cv75FuiQXX7QkGQxtoD-otgvhZ2Fjk29o7Iy9ik7ewHGXOfoVw_ruGWi0YfXBTuqEJ6H666vvMN4BZWHtzhC0k5ceQslB9Xdntky-GQgDqNkkBf32GKwAFT9JJrkO2BfsB-wfBrTiHr0AABYNTNKTceA5dtR3UVpI492VUWQbY3YmWUUfKTI7fM4wRQIhAN3c-VHubCCkUtZXfWL1aiEXU1qWRiM_ayKmWLUafyFbAiARTwlVocoamd9S-cYBosRKso_XGAPzAedzpuE2tEjp1g==",
	"clientData": "eyAiY2hhbGxlbmdlIjogIllTMTludV9ZWWpnczI5WndrU3dRb2JyNzhPaURXRnoxeXFZZW85WUpmQnciLCAib3JpZ2luIjogImh0dHA6XC9cL2RlbW8ueXViaWNvLmNvbSIsICJ0eXAiOiAibmF2aWdhdG9yLmlkLmZpbmlzaEVucm9sbG1lbnQiIH0="
}
EOD;

u2fs\registration\verify($response);
?>
--EXPECTF--
Fatal error: Uncaught RuntimeException: U2FS_CHALLENGE_ERROR: Challenge error in %s:13
Stack trace:
#0 %s(13): u2fs\registration\verify('{\n\t"registratio...')
#1 {main}
  thrown in %s on line 13


