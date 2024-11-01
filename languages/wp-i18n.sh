#!/usr/bin/env bash

    # --- INSTALLED PLUGIN WORDPRESS PATHS ---

    # WITHOUT MERGE:
    # wp i18n make-pot wp-content/plugins/webphone/ wp-content/plugins/webphone/languages/webphone-dynamics-plugin-es_ES.po

    # WITH MERGE:
    # wp i18n make-pot --merge="wp-content/plugins/webphone/languages/webphone-dynamics-plugin-es_ES.po" wp-content/plugins/webphone/ wp-content/plugins/webphone/languages/webphone-dynamics-plugin-es_ES.po

    # msgfmt -o wp-content/plugins/webphone/languages/webphone-dynamics-plugin-es_ES.mo wp-content/plugins/webphone/languages/webphone-dynamics-plugin-es_ES.po





    # --- SVN WORDPRESS PATHS ---

    # WITHOUT MERGE:
    # wp i18n make-pot trunk/ trunk/languages/webphone-dynamics-plugin-es_ES.po

    # WITH MERGE:
    # wp i18n make-pot --merge="trunk/languages/webphone-dynamics-plugin-es_ES.po" trunk/ trunk/languages/webphone-dynamics-plugin-es_ES.po

    # msgfmt -o trunk/languages/webphone-dynamics-plugin-es_ES.mo trunk/languages/webphone-dynamics-plugin-es_ES.po