# services
cAPI v2 Composer Libraries

**cAPI v2 is currently under development. This composer library will be updated and branched prior to cAPI2 production release.**

## Overview
This composer package is to be used when building the Joomla Library extension for cAPI 2 before packaging it into an installable file.

cAPI2 requires a collection of external libraries to faciliate the following functionality:

- HTTP Route Handling (Slim)
- Swagger JSON Generation
- Non-blocking I/O, Event Handling and Data Streaming
- Basic Machine Learning & AI Functions
- Joomla Vendor Libraries

Using this composer package, a developer can ensure the proper versions of required packages are included in the Joomla library extension build. This library is currently distributed with the cAPI2 Package for Joomla (Under Development)

#### Purpose

While it would be possible in theory to extend the Joomla vendor library, this package serves as a working snapshot of libraries which work together effectively to serve cAPI2 functionality (once bundled into an installable Joomla library).

This allows for Joomla CMS & Platform changes (as well as ReactPHP, Slim Framework, etc.) to not affect core cAPI2 functionality until such changes are deemed acceptable for inclusion and determine to no cause dependency conflicts.

#### Original cAPI Documentation

https://learn.getcapi.org

#### cAPI Commercial Extension for Joomla

https://getcapi.org
