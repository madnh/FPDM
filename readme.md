#Form filling

###Informations

**Author**: Olivier

**License**: FPDF

**Description**

This script allows to merge data into a PDF form. Given a template PDF with text fields, it's possible to inject values in two different ways:
- from a PHP array
- from an FDF file
The resulting document is produced by the **Output()** method, which works the same as for **FPDF**.

**Note:** if your template PDF is not compatible with this script, you can process it with pdftk this way: __pdftk modele.pdf output modele2.pdf__

Then try again with __modele2.pdf__.

**Source**: [http://www.fpdf.org/en/script/script93.php](http://www.fpdf.org/en/script/script93.php)
