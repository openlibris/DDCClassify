| :warning: Composer support is currently broken. We are working on this.
| ---

# DDCClassify

## Introduction

DDCClassify uses OCLC's API (which powers WorldCat) and extracts the Dewey Decimal Classification using multiple methods. You can use it by ISBN or Title and Author.

## Usage

### Caching

Caching is used to speed up requests as uncached requests are quite slow. By default, requests are cached for a year.

### Introduction

Install DDCClassify by moving `src/DDCClassify.php` to your website directory.

### Classify

#### By ISBN

NOTE: This works best with ISBN 10.

```
$dewey->ClassifyISBN(string $isbn); -> string
```

Example (with includes and object creation):

```
require 'DDCClassify.php';
$dewey = new DeweyDecimal();
$dewey->ClassifyISBN('059309932X'); // Output: 813.54
```

#### By Title and Author

```
$dewey->ClassifyTitleAuthor(string $title, string $author = '' (optional)); -> string
```

Example (with includes and object creation):

```
require 'DDCClassify.php';
$dewey = new DeweyDecimal();
$dewey->ClassifyTitleAuthor('Dune', 'Frank Herbert'); // Output: 813.54
```
