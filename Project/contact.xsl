<?xml version="1.0"?>
<xsl:stylesheet version="1.0"
 xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
<html>
<head>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"/>

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"/>

</head>
<body>
  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="home.php">Bibliothèque publique française de Winnipeg</a>
      </div>
    </div>
  </nav>
<table summary="Table of movies">

<caption>If you would like to contact us, see the details below: </caption>

<thead>
  <tr>
    <th>Region</th>
    <th>Address</th>
    <th>Number</th>
    <th>Phone</th>
  </tr>
</thead>
<!-- <tfoot>
    <tr>
      <th>Region</th>
      <th>Address</th>
      <th>Number</th>
      <th>Phone</th>
    </tr>
</tfoot> -->
<xsl:for-each select="location/neighbourhood">
<xsl:sort select="info/locationindex" data-type="number" order="descending" />
<tr>
  <td><xsl:value-of select="place" /></td>
  <td><xsl:value-of select="info/address" /></td>
  <td><xsl:value-of select="info/number" /></td>
  <td><xsl:value-of select="info/phone" /></td>

</tr>
</xsl:for-each>
</table>

</body>
</html>
</xsl:template>
</xsl:stylesheet>
