<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/invoices">
        <html>
            <head>
                <title>Badge</title>
                <meta charset="utf8"/>
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
                      integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
                      crossorigin="anonymous"/>
            </head>
            <body>
                <div class="mt-5"></div>
                <div class="card m-auto">
                    <div class="card-body">

                        <div class="m-5">
                            <h2>TALON A CONSERVER</h2>

                            <div class="mt-5"></div>

                            <div class="d-block">
                                <p>
                                    Conférence : <xsl:value-of select="invoice/conference_name"/> <br/>
                                    Lien : <xsl:value-of select="invoice/conference_location"/><br/>
                                    Le <xsl:value-of select="invoice/conference_date"/>
                                </p>
                            </div>

                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Reçu n°</th>
                                        <td><xsl:value-of select="invoice/number"/></td>
                                    </tr>
                                    <tr>
                                        <th>Nom du client</th>
                                        <td><xsl:value-of select="invoice/username"/></td>
                                    </tr>
                                    <tr>
                                        <th>Objet</th>
                                        <td>Participaion à l'événement : <b><xsl:value-of select="invoice/event_title"/></b></td>
                                    </tr>
                                    <tr>
                                        <th>Montant</th>
                                        <td><xsl:value-of select="invoice/amount"/> Dh</td>
                                    </tr>
                                    <tr>
                                        <th>Date</th>
                                        <td><xsl:value-of select="invoice/date"/></td>
                                    </tr>
                                    <tr>
                                        <th>Méthode de paiement</th>
                                        <td><xsl:value-of select="invoice/payment_method"/></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-block">
                                <span class="pull-right float-right">
                                    Signature : <br/><br/>
                                    <img src="../../assets/img/signature.png" width="120"/>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    setTimeout(() => {4
                        window.print();
                        window.close();
                    }, 200);
                </script>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>