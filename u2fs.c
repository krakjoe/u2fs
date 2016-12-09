/*
  +----------------------------------------------------------------------+
  | PHP Version 7                                                        |
  +----------------------------------------------------------------------+
  | Copyright (c) 1997-2016 The PHP Group                                |
  +----------------------------------------------------------------------+
  | This source file is subject to version 3.01 of the PHP license,      |
  | that is bundled with this package in the file LICENSE, and is        |
  | available through the world-wide-web at the following url:           |
  | http://www.php.net/license/3_01.txt                                  |
  | If you did not receive a copy of the PHP license and are unable to   |
  | obtain it through the world-wide-web, please send a note to          |
  | license@php.net so we can mail you a copy immediately.               |
  +----------------------------------------------------------------------+
  | Author: krakjoe                                                      |
  +----------------------------------------------------------------------+
*/

/* $Id$ */

#ifdef HAVE_CONFIG_H
#include "config.h"
#endif

#include "php.h"
#include "php_ini.h"
#include "ext/spl/spl_exceptions.h"
#include "ext/standard/info.h"
#include "php_u2fs.h"

#include <u2f-server.h>

ZEND_BEGIN_MODULE_GLOBALS(u2fs)
	u2fs_ctx_t *ctx;
ZEND_END_MODULE_GLOBALS(u2fs)

ZEND_DECLARE_MODULE_GLOBALS(u2fs);

#define U2FS_G(v) ZEND_MODULE_GLOBALS_ACCESSOR(u2fs, v)

static void php_u2fs_init_globals(zend_u2fs_globals *u2fs) {
	memset(u2fs, 0, sizeof(zend_u2fs_globals));
}

#define php_u2fs_exception(rc) do { \
	zend_throw_exception_ex(spl_ce_RuntimeException, rc, \
			"%s: %s", \
			u2fs_strerror_name(rc), \
			u2fs_strerror(rc)); \
	return; \
} while(0)

/* {{{ PHP_MINIT_FUNCTION
 */
PHP_MINIT_FUNCTION(u2fs)
{
	ZEND_INIT_MODULE_GLOBALS(u2fs, php_u2fs_init_globals, NULL);

	if (u2fs_global_init(0) != U2FS_OK) {
		return FAILURE;
	}

	return SUCCESS;
}
/* }}} */

/* {{{ PHP_MSHUTDOWN_FUNCTION
 */
PHP_MSHUTDOWN_FUNCTION(u2fs)
{
	u2fs_global_done();

	return SUCCESS;
}
/* }}} */

/* {{{ PHP_RINIT_FUNCTION
 */
PHP_RINIT_FUNCTION(u2fs)
{
#if defined(COMPILE_DL_U2FS) && defined(ZTS)
	ZEND_TSRMLS_CACHE_UPDATE();
#endif

	if (u2fs_init(&U2FS_G(ctx)) != U2FS_OK) {
		return FAILURE;
	}
	
	return SUCCESS;
}
/* }}} */

/* {{{ PHP_RSHUTDOWN_FUNCTION
 */
PHP_RSHUTDOWN_FUNCTION(u2fs)
{
	if (U2FS_G(ctx)) {
		u2fs_done(U2FS_G(ctx));
	}

	return SUCCESS;
}
/* }}} */

/* {{{ PHP_MINFO_FUNCTION
 */
PHP_MINFO_FUNCTION(u2fs)
{
	php_info_print_table_start();
	php_info_print_table_header(2, "u2f host support", "enabled");
	php_info_print_table_end();
}
/* }}} */

ZEND_BEGIN_ARG_INFO_EX(php_u2fs_setOrigin_arginfo, 0, 0, 1)
	ZEND_ARG_TYPE_INFO(0, origin, IS_STRING, 0)
ZEND_END_ARG_INFO()

/* {{{ proto void u2fs_setOrigin(string origin) */
PHP_FUNCTION(u2fs_setOrigin) 
{
	u2fs_rc rc;
	zend_string *origin = NULL;

	if (zend_parse_parameters_throw(ZEND_NUM_ARGS(), "S", &origin) != SUCCESS) {
		return;
	}

	rc = u2fs_set_origin(U2FS_G(ctx), ZSTR_VAL(origin));

	if (rc != U2FS_OK) {
		php_u2fs_exception(rc);
	}
} /* }}} */

ZEND_BEGIN_ARG_INFO_EX(php_u2fs_setAppId_arginfo, 0, 0, 1)
	ZEND_ARG_TYPE_INFO(0, id, IS_STRING, 0)
ZEND_END_ARG_INFO()

/* {{{ proto void u2fs_setAppId(string id) */
PHP_FUNCTION(u2fs_setAppId) 
{
	u2fs_rc rc;
	zend_string *id = NULL;

	if (zend_parse_parameters_throw(ZEND_NUM_ARGS(), "S", &id) != SUCCESS) {
		return;
	}

	rc = u2fs_set_appid(U2FS_G(ctx), ZSTR_VAL(id));

	if (rc != U2FS_OK) {
		php_u2fs_exception(rc);
	}
} /* }}} */

ZEND_BEGIN_ARG_INFO_EX(php_u2fs_setChallenge_arginfo, 0, 0, 1)
	ZEND_ARG_TYPE_INFO(0, challenge, IS_STRING, 0)
ZEND_END_ARG_INFO()

/* {{{ proto void u2fs_setChallenge(string challenge) */
PHP_FUNCTION(u2fs_setChallenge) 
{
	u2fs_rc rc;
	zend_string *challenge = NULL;

	if (zend_parse_parameters_throw(ZEND_NUM_ARGS(), "S", &challenge) != SUCCESS) {
		return;
	}

	rc = u2fs_set_challenge(U2FS_G(ctx), ZSTR_VAL(challenge));

	if (rc != U2FS_OK) {
		php_u2fs_exception(rc);
	}
} /* }}} */

ZEND_BEGIN_ARG_INFO_EX(php_u2fs_setKeyHandle_arginfo, 0, 0, 1)
	ZEND_ARG_TYPE_INFO(0, handle, IS_STRING, 0)
ZEND_END_ARG_INFO()

/* {{{ proto void u2fs_setKeyHandle(string handle) */
PHP_FUNCTION(u2fs_setKeyHandle) 
{
	u2fs_rc rc;
	zend_string *handle = NULL;

	if (zend_parse_parameters_throw(ZEND_NUM_ARGS(), "S", &handle) != SUCCESS) {
		return;
	}

	rc = u2fs_set_keyHandle(U2FS_G(ctx), ZSTR_VAL(handle));

	if (rc != U2FS_OK) {
		php_u2fs_exception(rc);
	}
} /* }}} */

ZEND_BEGIN_ARG_INFO_EX(php_u2fs_setPublicKey_arginfo, 0, 0, 1)
	ZEND_ARG_TYPE_INFO(0, key, IS_STRING, 0)
ZEND_END_ARG_INFO()

/* {{{ proto void u2fs_setPublicKey(string key) */
PHP_FUNCTION(u2fs_setPublicKey) 
{
	u2fs_rc rc;
	zend_string *key = NULL;

	if (zend_parse_parameters_throw(ZEND_NUM_ARGS(), "S", &key) != SUCCESS) {
		return;
	}

	rc = u2fs_set_publicKey(U2FS_G(ctx), ZSTR_VAL(key));

	if (rc != U2FS_OK) {
		php_u2fs_exception(rc);
	}
} /* }}} */

ZEND_BEGIN_ARG_WITH_RETURN_TYPE_INFO_EX(php_u2fs_authentication_challenge_arginfo, 0, 0, IS_STRING, NULL, 0)
ZEND_END_ARG_INFO()

/* {{{ proto string u2fs\authentication\challenge() */
PHP_FUNCTION(u2fs_authentication_challenge)
{
	u2fs_rc rc;
	char *output = NULL;

	if (zend_parse_parameters_none() != SUCCESS) {
		return;
	}

	rc = u2fs_authentication_challenge(U2FS_G(ctx), &output);

	if (rc != U2FS_OK) {
		php_u2fs_exception(rc);
	}

	RETVAL_STRING(output);
	free(output);
} /* }}} */

ZEND_BEGIN_ARG_WITH_RETURN_TYPE_INFO_EX(php_u2fs_authentication_verify_arginfo, 0, 0, IS_ARRAY, NULL, 0)
	ZEND_ARG_TYPE_INFO(0, response, IS_STRING, 0)
ZEND_END_ARG_INFO()

/* {{{ proto array u2fs\authentication\verify(string response) */
PHP_FUNCTION(u2fs_authentication_verify)
{
	u2fs_rc rc;
	zend_string *response = NULL;
	u2fs_auth_res_t *output = NULL;

	if (zend_parse_parameters_throw(ZEND_NUM_ARGS(), "S", &response) != SUCCESS) {
		return;
	}

	rc = u2fs_authentication_verify(U2FS_G(ctx), ZSTR_VAL(response), &output);

	if (rc != U2FS_OK) {
		php_u2fs_exception(rc);
	} else {
		u2fs_rc verified;
		uint32_t counter;
		uint8_t present;

		rc = u2fs_get_authentication_result(output, &verified, &counter, &present);

		if (rc != U2FS_OK) {
			u2fs_free_auth_res(output);

			php_u2fs_exception(rc);
		}

		array_init(return_value);

		add_assoc_bool(return_value, "verified", verified == U2FS_OK);
		add_assoc_long(return_value, "counter", counter);
		add_assoc_long(return_value, "present", present);
	}

	u2fs_free_auth_res(output);
} /* }}} */

ZEND_BEGIN_ARG_WITH_RETURN_TYPE_INFO_EX(php_u2fs_registration_challenge_arginfo, 0, 0, IS_STRING, NULL, 0)
ZEND_END_ARG_INFO()

/* {{{ proto string u2fs\registration\challenge() */
PHP_FUNCTION(u2fs_registration_challenge)
{
	u2fs_rc rc;
	char *output = NULL;

	if (zend_parse_parameters_none() != SUCCESS) {
		return;
	}

	rc = u2fs_registration_challenge(U2FS_G(ctx), &output);

	if (rc != U2FS_OK) {
		php_u2fs_exception(rc);
	}

	RETVAL_STRING(output);
	free(output);
} /* }}} */

ZEND_BEGIN_ARG_WITH_RETURN_TYPE_INFO_EX(php_u2fs_registration_verify_arginfo, 0, 0, IS_ARRAY, NULL, 0)
	ZEND_ARG_TYPE_INFO(0, response, IS_STRING, 0)
ZEND_END_ARG_INFO()

/* {{{ proto array u2fs\registration\verify(string response) */
PHP_FUNCTION(u2fs_registration_verify)
{
	u2fs_rc rc;
	zend_string *response = NULL;
	u2fs_reg_res_t *output = NULL;

	if (zend_parse_parameters_throw(ZEND_NUM_ARGS(), "S", &response) != SUCCESS) {
		return;
	}

	rc = u2fs_registration_verify(U2FS_G(ctx), ZSTR_VAL(response), &output);

	if (rc != U2FS_OK) {
		php_u2fs_exception(rc);
	} else {
		const char *handle = u2fs_get_registration_keyHandle(output);
		const char *key    = u2fs_get_registration_publicKey(output);

		array_init(return_value);

		add_assoc_string(return_value, "handle", (char*) handle);
		add_assoc_string(return_value, "key",    (char*) key);
	}

	u2fs_free_reg_res(output);
} /* }}} */

/* {{{ u2fs_functions[]
 */
const zend_function_entry u2fs_functions[] = {
	ZEND_NS_FENTRY("u2fs", setOrigin,      ZEND_FN(u2fs_setOrigin),      php_u2fs_setOrigin_arginfo, 0)
	ZEND_NS_FENTRY("u2fs", setAppId,       ZEND_FN(u2fs_setAppId),       php_u2fs_setAppId_arginfo, 0)
	ZEND_NS_FENTRY("u2fs", setChallenge,   ZEND_FN(u2fs_setChallenge),   php_u2fs_setChallenge_arginfo, 0)
	ZEND_NS_FENTRY("u2fs", setKeyHandle,   ZEND_FN(u2fs_setKeyHandle),   php_u2fs_setKeyHandle_arginfo, 0)
	ZEND_NS_FENTRY("u2fs", setPublicKey,   ZEND_FN(u2fs_setPublicKey),   php_u2fs_setPublicKey_arginfo, 0)

	ZEND_NS_FENTRY("u2fs\\authentication", challenge, ZEND_FN(u2fs_authentication_challenge), php_u2fs_authentication_challenge_arginfo, 0)
	ZEND_NS_FENTRY("u2fs\\authentication", verify,    ZEND_FN(u2fs_authentication_verify),    php_u2fs_authentication_verify_arginfo, 0)

	ZEND_NS_FENTRY("u2fs\\registration",   challenge, ZEND_FN(u2fs_registration_challenge),   php_u2fs_registration_challenge_arginfo, 0)
	ZEND_NS_FENTRY("u2fs\\registration",   verify,    ZEND_FN(u2fs_registration_verify),      php_u2fs_registration_verify_arginfo, 0)
	PHP_FE_END
};
/* }}} */

/* {{{ u2fs_module_entry
 */
zend_module_entry u2fs_module_entry = {
	STANDARD_MODULE_HEADER,
	"u2fs",
	u2fs_functions,
	PHP_MINIT(u2fs),
	PHP_MSHUTDOWN(u2fs),
	PHP_RINIT(u2fs),	
	PHP_RSHUTDOWN(u2fs),
	PHP_MINFO(u2fs),
	PHP_U2FS_VERSION,
	STANDARD_MODULE_PROPERTIES
};
/* }}} */

#ifdef COMPILE_DL_U2FS
#ifdef ZTS
ZEND_TSRMLS_CACHE_DEFINE()
#endif
ZEND_GET_MODULE(u2fs)
#endif

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 * vim600: noet sw=4 ts=4 fdm=marker
 * vim<600: noet sw=4 ts=4
 */
