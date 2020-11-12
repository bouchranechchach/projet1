<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/attestations">
        <html>
            <head>
                <title>Attestation de participation</title>
                <meta charset="utf8"/>
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
                      integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
                      crossorigin="anonymous"/>
            </head>
            <body>
                <div class="mt-5"></div>

                <div class="ml-5 mr-5 p-4">
                    <div class="mt-5"></div>
                    <h2>ATTESTATION   DE   PARTICIPATION</h2>
                    <br/>
                    <br />
                    <p style="font-size:18px">
                        Je  soussigné  <xsl:value-of select="attestation/organiser" />  atteste  que
                        <xsl:value-of select="attestation/gender"/>
                        <xsl:value-of select="attestation/username"/> a assisté à  la conférence, sur
                        <xsl:value-of select="attestation/conference_name"/>
                        en date du <xsl:value-of select="attestation/conference_date"/>
                        qui avait lieu à <xsl:value-of select="attestation/conference_location"/>
                    </p>
                    <br/>
                    <br />
                    <p style="font-size:18px">
                        Fait  à  <xsl:value-of select="attestation/conference_location"/>,  le
                        <xsl:value-of select="attestation/now"/>
                        <span class="float-right pull-right">
                            Signature<br/><br/>
                            <img src="../../assets/img/signature.png" width="120" class="mr-2 mb-5"/>
                        </span>
                    </p>
                    <div class="mb-5"></div>
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