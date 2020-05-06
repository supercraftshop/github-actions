PHP Code sniffer Github action
=
This action runs phpcs with Supercraft ruleset with github action

Usage
-

Add this code to `.github/workflows/main.yml` file.

    name: PHPCS check
      on: push/pull_request

      jobs:
        phpcs:
          name: PHPCS
          runs-on: ubuntu-latest
          steps:
            - uses: actions/checkout@v2
            - name: PHPCS check
              uses: supercraftshop/github-actions@master 

By default php_cs checks the code in `modules` directory.
You can pass a set of your own directories using `paths` input

    - name: PHPCS check
      uses: supercraftshop/github-actions@master
      with:
        paths: './modules ./plugins ./any_other_dir
        
How to use CodeSniffer (phpcs) locally and/or with PhpStorm
-
Download last version of phpcs:
`curl -OL https://squizlabs.github.io/PHP_CodeSniffer/phpcs.phar`
or using wget
`wget https://squizlabs.github.io/PHP_CodeSniffer/phpcs.phar`
Check phar: `php phpcs.phar -h`

For debian-like systems, make symlink of binary to global scope (sudo):  
`ln -s \path\to\downloaded\phar \usr\bin\phpcs`  
`chmod +x \usr\bin\phpcs`

How to set Supercraft coding standart:
- Download `Supercraft` directory from this repo
- Set new standart for phpcs: `phpcs --config-set installed_paths path/to/supercraft_standard`
- Check that `Supercraft` string exists in the output of `phpcs -i`

**How to use CodeSniffer with Supercraft standarts in CLI:**

To check single class:  
`phpcs --standard=Supercraft /path/to/php/class.php`

You can set Supercraft standart as default:  
`phpcs --config-set default_standard Supercraft`
then 
`phpcs /path/to/php/class.php`

For more usage cases check [official documentation](https://github.com/squizlabs/PHP_CodeSniffer/wiki "Title")

**How to setup phpcs in PHPStorm**
- `Preferences -> Languages & Frameworks -> PHP -> Quality tools -> Code Sniffer`
In Configuration Local intup click `...` button.  
Set path to phpcs binary and click `Validate`. The current version on phpcs must be shown  
Set 15 - 30 in `Tool process timeout` input.  
`Apply -> OK.`

- `Preferences -> Editor -> Inspections -> PHP -> Quality tools -> PHP Code Sniffer validation`  
Select `Supercraft` in `Coding Standard` selectbox.

- `File -> Invalidate Caches / Restart`   

        

          
    
