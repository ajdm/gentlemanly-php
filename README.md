# Gentlemanly PHP
## Introduction
Many of the early pioneers of computer science, such as Charles Babbage and Ada Lovelace, were British and came from a time when communication was much more civilised than now and letter writing was commonplace.
Whilst most programming languages today use a subset of English for their keywords, the terse conciseness of modern code would make it very alien to those early developers.
This short script goes some way to solving this problem, allowing the user to write a computer programme in a manner much more becoming an English gentleman or lady.

## Usage
The mappings from Gentlemanly PHP to actual PHP can be seen in the source code, defined in the `$syntax` array.
A file containing Gentlemanly PHP code can be passed to the interpreter, which will by default evaluate the code and write a 'proper' PHP version to a separate file.
To evaluate and translate a file `instructions.gphp` to instructions.php, use:

    php interpreter.php instructions.gphp

To prevent the evaluation of the code, and to save the translated version to a file called `translated.php`, use:

    php interpreter.php --eval=false --outfile=translated.php instructions.php

## Acknowledgements
This was started after reading the entertaining article _[If PHP were British](https://www.addedbytes.com/blog/if-php-were-british/)_, by Dave Child.
