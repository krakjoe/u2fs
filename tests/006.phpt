--TEST--
u2fs\authentication\verify U2FS_SIGNATURE_ERROR
--SKIPIF--
<?php if (!extension_loaded("u2fs")) print "skip"; ?>
--FILE--
<?php 
u2fs\setAppId("http://demo.yubico.com");
u2fs\setOrigin("http://demo.yubico.com");
u2fs\setChallenge("v31IKBFdLkdN_Z9tXfAxydupofCf89k6A4a7to0OjTo");
u2fs\setPublicKey(implode(null, array_map('chr', [
	0x04, 0xb4, 0x21, 0x96, 0x10, 0x25, 0xd3, 0x61, 0xe6, 0x3d, 0x3d, 0x68,
    0x0d, 0x64, 0xd1, 0x40, 0x7c, 0xeb, 0x7b, 0x7b, 0x58, 0x28, 0x6b, 0x47,
    0x77, 0xd4, 0x31, 0x97, 0x6a, 0xc6, 0xd4, 0xd3, 0x36, 0x86, 0xcf, 0xdb,
    0x79, 0x33, 0x04, 0x78, 0x70, 0x11, 0xaa, 0x75, 0x16, 0xfb, 0xae, 0x18,
    0xf5, 0x1d, 0xcd, 0x1e, 0x2c, 0x69, 0xab, 0xf3, 0x12, 0x75, 0xed, 0xed,
	0xfc, 0x5f, 0x8c, 0xad, 0x54
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
Fatal error: Uncaught RuntimeException: U2FS_SIGNATURE_ERROR: Unable to verify signature in %s:22
Stack trace:
#0 %s(22): u2fs\authentication\verify('{\n\t"signatureDa...')
#1 {main}
  thrown in %s on line 22





