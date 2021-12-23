<?php
// ... But this is only a subset of all the available configuration options. 
return [
    'ssl' => [
        /*
        * Path to local certificate file on filesystem. It must be a PEM encoded file which
        * contains your certificate and private key. It can optionally contain the
        * certificate chain of issuers. The private key also may be contained
        * in a separate file specified by local_pk.
        */
        'local_cert' => env('CERT_PATH_CERT'),

        /*
        * Path to local private key file on filesystem in case of separate files for
        * certificate (local_cert) and private key.
        */
        'local_pk' => env('CERT_PATH_KEY'),

        /*
        * Passphrase with which your local_cert file was encoded.
        */
        'passphrase' => env('CERT_PASSPHRASE'),
    ],
];