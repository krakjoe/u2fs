PHP_ARG_WITH(u2fs, for u2fs support,
[  --with-u2fs             Include u2fs support])

if test "$PHP_U2FS" != "no"; then
  SEARCH_PATH="/usr/local /usr" 
  SEARCH_FOR="/include/u2f-host/u2f-host.h"
  if test -r $PHP_U2FS/$SEARCH_FOR; then
    U2FS_DIR=$PHP_U2FS
  else
    AC_MSG_CHECKING([for u2f files in default path])
    for i in $SEARCH_PATH ; do
      if test -r $i/$SEARCH_FOR; then
        U2FS_DIR=$i
        AC_MSG_RESULT(found in $i)
      fi
    done
  fi

  if test -z "$U2FS_DIR"; then
    AC_MSG_RESULT([not found])
    AC_MSG_ERROR([Please reinstall the u2fs distribution])
  fi

  # --with-u2fs -> add include path
  PHP_ADD_INCLUDE($U2FS_DIR/include)
  PHP_ADD_INCLUDE($U2FS_DIR/include/u2f-server)

  LIBNAME=u2f-server # you may want to change this
  LIBSYMBOL=u2fs_global_done # you most likely want to change this 

  PHP_CHECK_LIBRARY($LIBNAME,$LIBSYMBOL,
  [
    PHP_ADD_LIBRARY_WITH_PATH($LIBNAME, $U2FS_DIR/$PHP_LIBDIR, U2FS_SHARED_LIBADD)
    AC_DEFINE(HAVE_U2FSLIB,1,[ ])
  ],[
    AC_MSG_ERROR([wrong u2f-server lib version or lib not found])
  ],[
    -L$U2FS_DIR/$PHP_LIBDIR -lm
  ])
  dnl
  PHP_SUBST(U2FS_SHARED_LIBADD)

  PHP_NEW_EXTENSION(u2fs, u2fs.c, $ext_shared,, -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1)
fi
