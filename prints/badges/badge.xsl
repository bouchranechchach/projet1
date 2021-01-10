<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/badges">
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
                <div class="card m-auto"
                     style="background-color:#b2bec3;width:80%">
                    <div class="card-body d-flex">
                        <div class="col-md-4 text-center">
                            <img src="../../{badge/avatar}" class="img img-thumbnail" style="width:200px;"/>
                        </div>
                        <div class="col-md-8">
                            <h4>
                                Conférence :
                                <xsl:value-of select="badge/conference"/>
                            </h4>
                            <br/>
                            <h5 class="card-title">
                                <xsl:if test="badge/@gender = 'male'">
                                    Monsieur
                                </xsl:if>
                                <xsl:if test="badge/@gender = 'female'">
                                    Madame
                                </xsl:if>
                                <xsl:value-of select="badge/username"/>
                            </h5>
                            <h6 class="card-subtitle mb-2 card-link">
                                <xsl:value-of select="badge/email" />
                            </h6>
                            <p class="card-text">
                                <xsl:value-of select="badge/university"/>
                            </p>
                            <span class="card-link">
                                Téléphone :
                                <xsl:value-of select="badge/phone"/>
                            </span>
                            <br/>
                            <span class="float-right"><b>@ConfApp</b></span>
                        </div>
                    </div>
                </div>

                <script>
                    setTimeout(() => {
                        window.print();
                        window.close();
                    }, 200);
                </script>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>