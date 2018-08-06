# poc-env-phar

A small POC illustrating .env and ENV VARs usage with PHP Archive (Phar)

## Development Usage

During development the .env file is used automatically

```bash
$ cp .env.dist .env
$ php bin/console

Using ENV VARs from .env file without overwriting existing ones.
ENV PHAR POC 0.1.0

Usage:
  command [options] [arguments]

Options:
  -h, --help            Display this help message
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi            Force ANSI output
      --no-ansi         Disable ANSI output
  -n, --no-interaction  Do not ask any interactive question
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

Available commands:
  help                   Displays help for a command
  list                   Lists commands
 env-phar
  env-phar:test          POC for ENV VARS with Phars
  env-phar:test-another  POC for ENV VARS with Phars
```

## Production Usage

When releasing a Phar, using [phar-builder](https://github.com/MacFJA/PharBuilder) in this case, the .env file is not present.
The ENV VARs currently present will be used instead.
The [phpdotenv](https://github.com/vlucas/phpdotenv) package is used to verify all required ENV VARs exist. 
When one or more are not set, this will be shown in the console.

```bash
$ phar-builder package
$ php env-phar.phar

Could not read from .env file. Checking existing ENV VARs instead!
One or more environment variables failed assertions: TEST_ENV_VAR is missing, TEST_ANOTHER_ENV_VAR is missing.

# set the missing ENV VARs
$ export TEST_ENV_VAR=1
$ export TEST_ANOTHER_ENV_VAR=2

$ php env-phar.phar

Could not read from .env file. Checking existing ENV VARs instead!
ENV PHAR POC 0.1.0

Usage:
  command [options] [arguments]

Options:
  -h, --help            Display this help message
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi            Force ANSI output
      --no-ansi         Disable ANSI output
  -n, --no-interaction  Do not ask any interactive question
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

Available commands:
  help                   Displays help for a command
  list                   Lists commands
 env-phar
  env-phar:test          POC for ENV VARS with Phars
  env-phar:test-another  POC for ENV VARS with Phars
```

## Possible Improvements
This minimal POC only shows a basic implementation of using ENV VARs with a Phar.
The POC can be improved in several ways:

### Advanced ENV VAR Usage
The [phpdotenv](https://github.com/vlucas/phpdotenv) package offers more functionality, 
like overwriting existing ENV VARs when using .env files, checking for empty ENV VARs, 
performing some type checks and checking whether an ENV VARs is one of several allowed values.
The UsingEnvironmentVariablesInterface could be extended for these types of requirements.

### Improving Packaging
Currently we're using [phar-builder](https://github.com/MacFJA/PharBuilder) because it's really simple, 
but we might opt for packages, such as [humbug/box](https://github.com/humbug/box), 
when we need more functionality.
In addition to that, [Phive](https://phar.io/) could also be implemented.

### Output
Informative and error output can be improved, for example with tables for missing ENV VARs (including type information)

### Improving Examples
Currently just a var_dump of ENV VARs. Can be made nicer.

### Setting Required ENV VARs
Currently the ENV VARs required by a command are defined like (arrays of) strings. 
We might want to improve this for better (static) code analysis by removing 'string based identifiers'.

### Generating .env.dist
During speedy development practices, one could forget to define a new placeholder value within the .env.dist file.
Because all required ENV VARs are known at runtime, we can create a Command that automatically updates an .env.dist file based on defined ENV VARs.

### Overruling ENV VARs
By default, _phpdotenv_ does not overrule any ENV VARs that are already defined.
We could implement a flag that allows for overruling existing ENV VARs anyway, which can be handy for testing purposes.
