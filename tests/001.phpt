--TEST--
u2fs\setChallenge U2FS_CHALLENGE_ERROR
--SKIPIF--
<?php if (!extension_loaded("u2fs")) print "skip"; ?>
--FILE--
<?php 
u2fs\setChallenge("");
?>
--EXPECTF--
Fatal error: Uncaught RuntimeException: U2FS_CHALLENGE_ERROR: Challenge error in %s:2
Stack trace:
#0 %s(2): u2fs\setChallenge('')
#1 {main}
  thrown in %s on line 2
