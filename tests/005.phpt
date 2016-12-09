--TEST--
u2fs\authentication\verify U2FS_CHALLENGE_ERROR
--SKIPIF--
<?php if (!extension_loaded("u2fs")) print "skip"; ?>
--FILE--
<?php 
u2fs\setAppId("http://demo.yubico.com");
u2fs\setOrigin("http://demo.yubico.com");
u2fs\setChallenge("0000000000000000000000000000000000000000000");
u2fs\setPublicKey(implode(null, array_map('chr', [
	0x04, 0x14, 0xc3, 0x2e, 0x41, 0x0b, 0x30, 0x9d, 0x6e, 0x93, 0x7f, 0x8b,
    0x5d, 0x81, 0xf9, 0xe5, 0x64, 0xfd, 0x11, 0x2c, 0xe5, 0xfe, 0xf0, 0x10,
    0x5e, 0xfb, 0xec, 0xd5, 0x55, 0x54, 0x52, 0x25, 0x25, 0xe4, 0x54, 0x29,
    0x0f, 0xf4, 0x2e, 0xa1, 0xd8, 0x77, 0x19, 0x36, 0x12, 0xe3, 0x6e, 0x39,
    0x17, 0x91, 0x24, 0xb5, 0x93, 0x8e, 0xe0, 0xfe, 0xf3, 0x69, 0xac, 0xb9,
	0x4c, 0x37, 0x97, 0x83, 0xcb
])));

$response = <<<EOD
{
	"signatureData": "AQAAACYwRAIgXUFB4phCuqcc0-a9obD8S_eMuMJbTC0_VrWizmwHadECIAXb_GaAEIuAJv806eUvMjc2Qi-ii5IMbNw2YU2t39Wp",
	"clientData": "eyAiY2hhbGxlbmdlIjogInYzMUlLQkZkTGtkTl9aOXRYZkF4eWR1cG9mQ2Y4OWs2QTRhN3RvME9qVG8iLCAib3JpZ2luIjogImh0dHA6XC9cL2RlbW8ueXViaWNvLmNvbSIsICJ0eXAiOiAibmF2aWdhdG9yLmlkLmdldEFzc2VydGlvbiIgfQ==",
	"keyHandle": "kAbb2p57pxHg2mY8y_Kgcdc7jnnAoncJm8vOgqfigyWTvPGFlvxA04ULD9IJ-KpSyn733LRbJ-CG573N9jCY1g"
}
EOD;

var_dump(u2fs\authentication\verify($response));
?>
--EXPECTF--
Fatal error: Uncaught RuntimeException: U2FS_CHALLENGE_ERROR: Challenge error in %s:22
Stack trace:
#0 %s(22): u2fs\authentication\verify('{\n\t"signatureDa...')
#1 {main}
  thrown in %s on line 22




