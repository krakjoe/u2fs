--TEST--
u2fs\registration\verify
--SKIPIF--
<?php if (!extension_loaded("u2fs")) print "skip"; ?>
--FILE--
<?php 
u2fs\setAppId("http://demo.yubico.com");
u2fs\setOrigin("http://demo.yubico.com");
u2fs\setChallenge("YS19nu_YYjgs29ZwkSwQobr78OiDWFz1yqYeo9YJfBw");

$expect = [
	0x04, 0x5c, 0x6d, 0xd1, 0x38, 0x3c, 0x71, 0x91, 0x68, 0x95, 0x13, 0x2b,
    0xd8, 0x58, 0xe0, 0x6a, 0xd7, 0xfe, 0x36, 0x5a, 0xe5, 0xe5, 0xa0,
    0x8c, 0x92, 0xba, 0x21, 0xfc, 0x1e, 0xce, 0xb9, 0xdd, 0x1e, 0xf4,
    0x22, 0xed, 0x04, 0x2d, 0x60, 0x0d, 0xaa, 0x02, 0x0e, 0x0d, 0xad,
    0xe6, 0xcd, 0x91, 0x20, 0xa8, 0x3b, 0x02, 0x74, 0x57, 0x53, 0xf3,
	0x2e, 0x53, 0xf5, 0x5a, 0xbf, 0xce, 0x92, 0xef, 0xf4
];

$response = <<<EOD
{
	"registrationData": "BQRcbdE4PHGRaJUTK9hY4GrX_jZa5eWgjJK6IfwezrndHvQi7QQtYA2qAg4NrebNkSCoOwJ0V1PzLlP1Wr_Oku_0QKfeNR0Ei4_I40GCo5xjm4Q7hnZwzXQ5f5vjtnx7xIqCZ-z7GOGExeouBXxaMgleYpX7xMR6Y9wa_qzLLTAr6IcwggIbMIIBBaADAgECAgR1o_Z1MAsGCSqGSIb3DQEBCzAuMSwwKgYDVQQDEyNZdWJpY28gVTJGIFJvb3QgQ0EgU2VyaWFsIDQ1NzIwMDYzMTAgFw0xNDA4MDEwMDAwMDBaGA8yMDUwMDkwNDAwMDAwMFowKjEoMCYGA1UEAwwfWXViaWNvIFUyRiBFRSBTZXJpYWwgMTk3MzY3OTczMzBZMBMGByqGSM49AgEGCCqGSM49AwEHA0IABBmjfkNqa2mXzVh2ZxuES5coCvvENxDMDLmfd-0ACG0Fu7wR4ZTjKd9KAuidySpfona5csGmlM0Te_Zu35h_wwujEjAQMA4GCisGAQQBgsQKAQIEADALBgkqhkiG9w0BAQsDggEBAb0tuI0-CzSxBg4cAlyD6UyT4cKyJZGVhWdtPgj_mWepT3Tu9jXtdgA5F3jfZtTc2eGxuS-PPvqRAkZd40AXgM8A0YaXPwlT4s0RUTY9Y8aAQzQZeAHuZk3lKKd_LUCg5077dzdt90lC5eVTEduj6cOnHEqnOr2Cv75FuiQXX7QkGQxtoD-otgvhZ2Fjk29o7Iy9ik7ewHGXOfoVw_ruGWi0YfXBTuqEJ6H666vvMN4BZWHtzhC0k5ceQslB9Xdntky-GQgDqNkkBf32GKwAFT9JJrkO2BfsB-wfBrTiHr0AABYNTNKTceA5dtR3UVpI492VUWQbY3YmWUUfKTI7fM4wRQIhAN3c-VHubCCkUtZXfWL1aiEXU1qWRiM_ayKmWLUafyFbAiARTwlVocoamd9S-cYBosRKso_XGAPzAedzpuE2tEjp1g==",
	"clientData": "eyAiY2hhbGxlbmdlIjogIllTMTludV9ZWWpnczI5WndrU3dRb2JyNzhPaURXRnoxeXFZZW85WUpmQnciLCAib3JpZ2luIjogImh0dHA6XC9cL2RlbW8ueXViaWNvLmNvbSIsICJ0eXAiOiAibmF2aWdhdG9yLmlkLmZpbmlzaEVucm9sbG1lbnQiIH0="
}
EOD;

$result = u2fs\registration\verify($response);

var_dump($result["handle"], 
		 $result["key"] == implode(null, array_map('chr', $expect)));
?>
--EXPECT--
string(86) "p941HQSLj8jjQYKjnGObhDuGdnDNdDl_m-O2fHvEioJn7PsY4YTF6i4FfFoyCV5ilfvExHpj3Br-rMstMCvohw"
bool(true)


