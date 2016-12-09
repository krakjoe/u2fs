u2fs
====

This is light wrapper around Yubico libu2fh server library for server side interaction with yubikeys.

API
==

The API very closely resembles the C library API, with the awkward bits (for PHP) removed:

	namespace u2fs;

	function setOrigin(string origin);

	function setAppId(string id);

	function setChallenge(string challenge);

	function setKeyHandle(string handle);

	function setPublicKey(string key);
	
	namespace u2fs\registration;

	function challenge() : string;

	function verify() : array;

	namespace u2fs\authentication;

	function challenge() : string;
	
	function verify() : array;


