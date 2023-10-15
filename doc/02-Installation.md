# Installation <a id="module-impersonate-installation"></a>

## Requirements <a id="module-impersonate-installation-requirements"></a>

* Icinga Web 2 (&gt;= 2.9)
* PHP (&gt;= 7.3)

## Installation from .tar.gz <a id="module-impersonate-installation-manual"></a>

Download the latest version and extract it to a folder named `impersonate`
in one of your Icinga Web 2 module path directories.

## Enable the newly installed module <a id="module-impersonate-installation-enable"></a>

Enable the `impersonate` module either on the CLI by running

```sh
icingacli module enable impersonate
```

Or go to your Icinga Web 2 frontend, choose `Configuration` -&gt; `Modules`, chose the `impersonate` module and `enable` it.

It might afterwards be necessary to refresh your web browser to be sure that
newly provided styling is loaded.