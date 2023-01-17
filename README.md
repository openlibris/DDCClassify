<a href="https://www.mrfake.name/ghpromo" target="_blank"><img src="https://mrfake.name/ghpromo/promo.png" height="250"></a>

| :package: Composer support has finally arrived!
| ---

# DDCClassify

NOTE: See the step-by-stop explanation (how to build it!) [on my blog](https://blog.mrfake.name/2022/08/12/dewey-decimal/)!

## Introduction

DDCClassify uses OCLC's API (which powers WorldCat) and extracts the Dewey Decimal Classification using multiple methods. You can use it by ISBN or Title and Author.

## Usage

### Introduction

Install DDCClassify using Composer.

```
composer require fakerybakery/ddcclassify
```

### Classify

#### By ISBN

NOTE: This works best with ISBN 10.

```
$dewey->ClassifyISBN(string $isbn); -> string
```

Example (with includes and object creation):

```
require 'vendor/autoload.php';
$dewey = new DeweyDecimal();
$dewey->ClassifyISBN('059309932X'); // Output: 813.54
```

#### By Title and Author

```
$dewey->ClassifyTitleAuthor(string $title, string $author = '' (optional)); -> string
```

Example (with includes and object creation):

```
require 'vendor/autoload.php';
$dewey = new DeweyDecimal();
$dewey->ClassifyTitleAuthor('Dune', 'Frank Herbert'); // Output: 813.54
```

&copy; 2022 mrfakename. All rights reserved.
