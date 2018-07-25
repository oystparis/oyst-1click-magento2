# Oyst 1-Click plugin for Magento 2

[![Build Status](https://travis-ci.org/oystparis/oyst-1click-magento2.svg?branch=master)](https://travis-ci.org/oystparis/oyst-1click-magento2)
[![Latest Stable Version](https://img.shields.io/badge/latest-1.0.0-green.svg)](https://github.com/oystparis/oyst-1click-magento2/releases/latest)
[![Magento = 2.0.x.x](https://img.shields.io/badge/magento-2.0-blue.svg)](#)
[![Magento = 2.1.x.x](https://img.shields.io/badge/magento-2.1-blue.svg)](#)
[![Magento = 2.2.x.x](https://img.shields.io/badge/magento-2.2-blue.svg)](#)
[![PHP >= 5.6](https://img.shields.io/badge/php-%3E=5.6-green.svg)](#)

You can sign up for an Oyst account at https://backoffice.oyst.com/signup.

This is the Oyst 1-Click plugin for Magento 2.x.
The plugin supports the Magento Community and Enterprise edition.

We commit all our new features directly into our GitHub repository.
But you can also request or suggest new features or code changes yourself!

## Installation

1. `composer config repositories.oyst-1click-magento2 git https://github.com/oystparis/oyst-1click-magento2`
2. `composer require oyst/oyst-1click-magento2` or `composer require oyst/oyst-1click-magento2:dev-[BRANCH-NAME]` for get release from specific branch
3. `php -f bin/magento module:enable Oyst_OneClick`
4. `php -f bin/magento setup:upgrade`

## Support

You can create issues on our repository or if you have some specific problems for your account you can contact <a href="mailto:plugin@oyst.com">plugin@oyst.com</a> as well.
