# simple-soap-client
Simple Soap Client Using PHP

## How to Install

### Using composer

        {
            ...
            "repositories": [
                {
                    "type": "vcs",
                    "url": "https://github.com/ajiyakin/simple-soap-client"
                }
            ],
            "require": {
                "ajiyakin/simplesoapclient": "1.0"
            }
            ...
        }

## How to Use

1. Create class that implementing `ajiyakin\simplesoapclient\config\SimpleSoapConfigInterface` for your custom configuration
2. Instantiate `ajiyakin\simplesoapclient\SimpleSoapClient` and inject your configuration object (from step 1 above)
3. Call `execute` function from that object (from step 2)


## Example

### Unit Testing Example

#### Not yet :D


