<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <title><?= $title ?></title>
    <style>
body {
    background-color: rgb(96%, 96%, 96%);
    margin-left: 10%;
    margin-right: 10%;
}

table {
    width: 100%;
    border-spacing: 0;

}

h1, h2 {
    background-color: rgb(20%, 20%, 20%);
    border: outset 1px;
    text-align: center;
    color: orange;
    font-family: Tahoma, Arial, sans-serif;
}

th {
    background-color: rgb(20%, 20%, 20%);
    border: outset 1px;
    color: orange;
    font-family: Tahoma, Arial, sans-serif;
}

td.dark {
    background-color: rgb(80%, 80%, 80%);
    border: outset 1px;
}

td.light {
    background-color: rgb(90%, 90%, 90%);
    border: outset 1px;
}

a:link, a:visited {
	color: orange;
	text-decoration: none;
	font-weight: bold;
}

a:hover {
	color: orange;
	text-decoration: underline;
	font-weight: bold;
}

p.copyright {
	text-align: center;
	font-size: small;
}
    </style>
  </head>
  <body>
    <h1><?= $title ?></h1>
    <h2>Summary</h2>
    <table align="center">
      <tr>
        <td>Run date:</td>
        <td><?= date('r', array_sum(explode(' ', microtime()))) ?></td>
      </tr>
      <tr>
        <td>Tests executed:</td>
        <td><?= $total ?></td>
      </tr>
      <tr>
        <td>Successes:</td>
        <td><?= $successes ?></td>
      </tr>
      <tr>
        <td>Failures:</td>
        <td><?= $failures ?></td>
      </tr>
    </table>
<?
Loop::run(
    new ArrayIterator($result->getTests()),
    new TestResultPrinter($result)
);
Loop::run(
    new ArrayIterator($missing),
    new MissingTestsPrinter
);
?>
    <p class="copyright">
	  Generated with PHPUnit 2.0, Copyright &copy; 2003 
	  by <a href="mailto:vincent@sunlight.tmfweb.nl">Vincent Oostindi&euml;</a>
    </p>
  </body>
</html>
