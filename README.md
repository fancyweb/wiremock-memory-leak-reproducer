`docker-compose up -d`

`docker-compose exec php /bin/sh -c 'php bin/console app:test'`

```
Last 500 took 15.101332902908 seconds.
Last 500 took 20.211616039276 seconds.
Last 500 took 19.051379919052 seconds.
Last 500 took 25.91952419281 seconds.
```

And then it hangs.

Change the version in the `docker-compose.yml` file from `2.27.1` to `2.26.3`.

`docker-compose down`

`docker-compose up -d`

`docker-compose exec php /bin/sh -c 'php bin/console app:test'`

```
Last 500 took 4.2752840518951 seconds.
Last 500 took 3.4692990779877 seconds.
Last 500 took 2.6607859134674 seconds.
Last 500 took 2.0749480724335 seconds.
Last 500 took 2.0268931388855 seconds.
Last 500 took 2.7379310131073 seconds.
etc..
```

It works perfectly.

The source code is located in `src/Command/TestCommand.php`.
