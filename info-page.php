<?php
    include 'db_connect.php';
    session_start();
? >
<html>
    <head>
        <title>Informatii-Belissima Design</title>
        <link rel="shortcut icon" href="./icon.ico">
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css"  href="./CSS/menu_bar-style.css">
        <link rel="stylesheet" type="text/css"  href="./CSS/general-style.css">
        <link rel="stylesheet" type="text/css"  href="./CSS/info-page.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=yes"/>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>
    <body onload="hide()" onresize="hide()">
        <div class="menu_bar">
            <div class="menu-icon">
                <img title="Meniu." src="./images/menu-icon2.png">
            </div>
            <div class="menu">
                    <ul>
                        <li><p>Menu</p></li>
                        <li><a href="./shop.php?q=rochie">Rochii</a></li>
                        <li><a href="./shop.php?q=bluza">Bluze</a></li>
                        <li><a href="./shop.php?q=fusta">Fuste</a></li>
                    </ul>
                    <ul style="margin-top: 70px;">
                        <span><li><a href="./shop.php">Magazin</a></li>
                        <li><a href="./info-page.php">Informații</a></li>
                        <li><a href="./contact-page.php">Contact</a></li></span>
                    </ul>
            </div>
            <div class="logo">
                    <a href="index.php"><img src="./images/logo_r2.png"></a>
            </div>
            <div class="basket">
                <a href="./cos-page.php" title="Cos de cumparaturi."><img src="./images/basket2.png"></a>
            </div>
            <?php
                if(isset($_SESSION["shopping_cart"]))
                {
                    $nr_p=count($_SESSION["shopping_cart"]);
                    $_SESSION['nr_p']=$nr_p;
                    if($_SESSION['nr_p']!=0)
                    {
                        echo "<div class='nr_p'>
                                    <p>".$_SESSION['nr_p']."</p>
                            </div>";
                    }
                }
            ? >
        </div>
        <div class="info">
            <h1>Informatii</h1>
            <div class="p_info">
                        <h2 class='ancor1'>Politica de confidențialitate:</h2>
                        <h3>Introducere</h3>
                        <p>Politica de confidențialitate trebuie luată in vedere doar de clienții și utilizatorii serviciilor 
                        noastre online. De fiecare dată când utilizați acest site web, veți fi supuși regulilor 
                        Politicii de confidențialitate și cea a cookie-urilor care sunt în vigoare în orice moment 
                        și ar trebui să consultați acest text pentru a vă asigura că sunteți de acord cu acestea.</p>
                        <p>Considerăm că ar trebui să vă simțiți informați și împuterniciți atunci când vine 
                        vorba de manipularea și utilizarea informațiilor dvs. Prin urmare, această notificare explică:</p>
                        <h3>Cine suntem?</h3>
                        <p>belissimadesign.com este administrat de proprietatea BELISSIMA DESIENER S.R.L.-D. 
                        (denumit belissimadesign.com sau noi).  BELISSIMA DESIENER S.R.L.-D. este situat în Baia Mare, Str. Aviatorilor,
                         nr. 3A, Județ Maramureș, România, mobil - (+40) 0721955639, reg. J24 / 61/16.01.2018, CUI 38699616,
                         care funcționează în conformitate cu legislația, normele și reglementările românești.</p>
                        <h3>Date personale</h3>
                        <p>Confidențialitatea datelor dvs. personale este esențială pentru noi. Prin intermediul acestui document,
                         ne propunem să vă informăm cu privire la modul în care prelucrăm datele si drepturile dvs. 
                        în conformitate cu Regulamentele europene referitoare la datele cu caracter personal, EU 679/2016, GDPR.</p>
                        <h3>Ce tipuri de date personale colectăm?</h3>
                        <p>În scopul prelucrării comenzilor, precum și al comunicărilor de tip marketing, prin folosirea site-ului 
                        si plasarea comenzilor, ne furnizați un set minim de date cu caracter personal, cum ar fi: e-mail, prenume/ nume,
                         număr de telefon, adresa. Vă rugăm să NU ne furnizați date cu caracter 
                        personal care nu sunt necesare pentru scopurile strict definite în politica de confidențialitate actuală.</p>
                        <h3>Care este motivul pentru care colectăm aceste date?</h3>
                        <p>Datele cu caracter personal furnizate de dvs. cu acordul dvs.
                         vor fi colectate și stocate de noi cu scopul de a ne ajuta cu una dintre următoarele:</p>
                        <ul>
                            <li>Pentru crearea, procesarea, expedierea și orice alt aspect legat de procesul de prelucrare a comenzilor online.</li>
                            <li>Pentru a vă trimite, în scopul comercializării, informații referitoare la ex.
                             informații privind produsele în curs de dezvoltare,
                             oferte, alte informații utile referitoare la procesul de comandă / expediere etc.</li>
                            <li>Pentru a ne îmbunătăți afacerile, bunurile și serviciile.</li>
                            <li>Pentru a lua decizii de afaceri.</li>
                            <li>Pentru a respecta anumite reglementări și cerințe legale.</li>
                            <li>Pentru a ne respecta și apăra drepturile noastre legale.</li>
                        </ul>
                        <h3>Cine are acces la aceste date?</h3>
                        <p>Datele cu caracter personal furnizate de dvs. sunt prelucrate numai de compania noastră.
                         În afara autorităților competente, este posibil
                         ca alți consultanți externi (ex. solicitori, avocați, contabili) să aibă acces la unele dintre aceste date.</p>
                        <p>Datele cu caracter personal nu vor fi comunicate niciunei terțe părți și nu vor fi procesate în afara UE.</p>
                        <h3>Cat timp sunt folosite aceste date?</h3>
                        <p>Datele cu caracter personal furnizate de dumneavoastră vor fi prelucrate pe parcursul obligațiilor noastre
                         contractuale / abonamentelor la newsletter, si dacă orice dispoziții legale ne obligă la o perioadă de timp
                          minimă, atunci această ultimă perioadă de timp se va aplica
                         (de exemplu, informațiile contabile și financiare sunt păstrate în conformitate cu legislația timp de 10 ani).</p>
                        <h3>Care sunt drepturile dumneavoastră?</h3>
                        <p>În calitate de utilizatori în cauză, în majoritatea cazurilor, aveți următoarele drepturi:</p>
                        <ul>
                            <li>Dreptul de a accesa informațiile personale pe care le deținem - în conformitate cu art. 15 din GDPR aveți
                             dreptul de a obține de la noi o confirmare a procesării datelor cu caracter personal efectuată de noi, 
                             precum și dreptul de acces la datele menționate anterior; pentru oricare din celelalte copii ale datelor 
                             solicitate de noi înșine, ne rezervăm dreptul de a solicita o taxă rezonabilă, bazată exclusiv pe costurile 
                             administrative ale furnizării acestor informații; în cazul în care această solicitare este primită pe suportul 
                             electronic (de exemplu, e-mail), si cu excepția cazului în care ați specificat un format diferit,
                             datele vă vor fi furnizate electronic într-un format utilizat la momentul solicitării.</li>
                            <li>Dreptul la modificări - aveți dreptul de a modifica sau de a solicita modificarea oricăreia dintre datele cu
                             caracter personal, în cazul în care acestea sunt inexacte, precum și dreptul de a completa informațiile care lipsesc.</li>
                            <li>Dreptul la ștergere - aveți dreptul deplin de a solicita ca toate datele personale deținute de noi să fie
                             șterse, fără întârzieri nejustificate și avem obligația de a șterge toate aceste date, atunci când:
                              (I) datele personale nu mai sunt necesare în scopul pentru care au fost colectate și prelucrate pentru prima
                               dată; (ii) retragi consimțământul pentru ca noi să prelucrăm și să colectăm datele menționate și nu există 
                               nicio bază legală pentru ca noi să le prelucrăm; (iii) vă opuneți procesării datelor și nu există motive legitime să prevaleze 
                               în ceea ce privește prelucrarea datelor; (iv) datele cu caracter personal au fost prelucrate ilegal; (v) datele cu caracter personal trebuie
                             șterse pentru a respecta obligațiile legale care decurg din reglementările stabilite de UE sau legislația română.</li>
                            <li>Dreptul la restricționarea procesării - în
                             conformitate cu art. 18 din GDPR aveți dreptul să ne restricționați de la procesarea informațiilor dvs.
                              personale.</li>
                            <li>Dreptul la portabilitatea datelor - aveți dreptul de a primi informațiile dvs. personale,
                             în același mod în care ne-au fost furnizate, într-un format structurat folosit de noi în momentul solicitării și
                              care poate fi citit automat;
                             aveți, de asemenea, dreptul de a solicita transmiterea acestor date altor operatori de date, în anumite situații.</li>
                            <li>Dreptul de a face o plângere în conformitate cu art.
                             77 din GDPR către Autoritatea Națională pentru Supravegherea Prelucrării Datelor cu Caracter Personal.</li>
                            <li>Dreptul de a retrage consimțământul în orice moment, 
                            fără a afecta legalitatea procesării datelor efectuate de noi înainte de retragerea consimțământului.</li>
                            <li>Pentru orice întrebări sau solicitări cu privire la datele cu caracter personal pe care le putem avea despre dvs., inclusiv pentru a vă exercita drepturile așa cum s-a arătat mai sus,
                             vă rugăm să ne contactați la adresa: orașul Baia Mare, Str. Aviatorilor, nr. 3A, Județ Maramureș, România.</li>
                        </ul>
                        <p>Această politică de confidențialitate a fost actualizată pe 11 noiembrie 2019.
                         Ne rezervăm dreptul de a o modifica periodic.</p>
                        <h3>Despre Cookie-uri</h3>
                        <p>Un cookie este un fișier text mic, care este salvat în timpul vizitei actuale si vizitelor ulterioare,
                         preluat de pe computer sau dispozitivul mobil. belissimadesign.com utilizează cookie-uri pentru a vă îmbunătăți și simplifica vizita.
                         Nu folosim cookie-uri pentru a stoca informații personale sau pentru a dezvălui informații către terți.</p>
                         <p>Folosim cookie-uri terțe pentru a colecta statistici sub formă agregată în instrumente de analiză, 
                         cum ar fi Google Analytics. Cookie-urile utilizate sunt cookie-uri permanente și temporare (cookie-uri de sesiune).
                          Cookie-urile permanente sunt stocate pe computer sau pe dispozitivul mobil pentru cel mult 24 de luni.</p> 
                    <br>
                    <h2 class='ancor2'>Serviciu clienți</h2>
                    <h3>Cum sa cumperi</h3>
                        <p>Sperăm că cumpărăturile online cu noi sunt o experiență ușoară și plăcută.</p>
                        <p>Urmați acești pași simpli pe care i-am creat pentru dvs. atunci când doriți să plasați comanda:</p>
                        <ul>
                            <li>Accesați pagina magazin, vizualizați produsele disponibile si faceți click pe produsul dorit.</li>
                            <li>Vizualizați produsul care vă interesează pentru a vedea toate
                             detaliile, dimensiunile disponibile, compoziția și prețul.</li>
                             <li>Adăugați-l în coș. Puteți alege apoi să continuați cumpărăturile sau să procesați comanda.</li>
                                <li>Dacă doriți să vă procesați comanda, puteți face acest lucru prin intrarea in pagina coșului de cumpărături.</li>
                                <li>Selectați o metoda de plata.</li>
                                <li>Apasati butonul de Confirmare comandă.</li>
                                <li>Veți primi un e-mail cu detaliile comenzii.</li>
                        </ul>
                    <!--<h3>Intrebari comune</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>-->
                    <h3 class='ancor3'>Plată</h3>
                        <p>Avem extrem de multa grija ca site-ul nostru sa fie cat mai sigur. 
                        Toate tranzacțiile cu cardul de credit / debit de pe acest site sunt procesate utilizând o securitate 3D, o poartă de plată online securizată care criptează detaliile cardului dvs. într-un mediu gazdă sigur. Aceste detalii 
                        vor fi complet criptate și utilizate doar pentru procesarea tranzacțiilor cu carduri pe care le-ați inițiat.</p>
                        <p>Metode de plata acceptate:</p>
                        <p>Acceptam plata Online cu card bancar prin EuPlatesc (Visa/Maestro/Mastercard).</p>
                        <p>Daca ati ales metoda de plata "prin card" este necesar sa completati un 
                        formular cu informatiile despre cardul dumneavoastra in pagina securizata a procesatorului de plati.</p>
                        <ul> 
                            <li>- Platile cu carduri de credit/debit emise sub sigla Visa si MasterCard (Visa/Visa Electron si MasterCard/Maestro)
                            se efectuaeaza prin intermediul sistemului "3-D Secure" elaborat de organizatiile care asigura tranzactiilor on-line acelasi nivel de securitate ca cele realizate la bancomat sau in mediul fizic, la comerciant.</li>
                            <li> - "3-D Secure" asigura in primul rand ca nici o informatie legata de cardul dumneavoastra nu este transferata sau stocata,
                            la nici un moment de timp, pe serverele magazinului  sau pe serverele procesatorului de plati, aceste date fiind direct introduse in sistemele Visa si MasterCard.</li>
                        </ul>         
                        <p>Acceptăm plata prin ramburs (produsele sunt platite odata ce coletul ajunge la dumneavoastră).</p>
                        <p>După ce ați făcut alegerea și ați plasat comanda, veți primi un e-mail / apel telefonic cu detaliile comenzii dvs.</p>
                    <h3 class='ancor4'>Livrare</h3>
                        <p>Livrarea se face prin curier odată ce produsul dumneavoastră a fost creat, ambalat si pregătit de livrare.</p>
                        <p>Costul livrării este gratis.</p>
                        <p>Deoarece creăm fiecare produs individual, 
                        uneori ar putea dura până la 15-20 zile ca produsul sa ajungă la dumneavoastră.</p>
                    <h3 class='ancor5'>Retur</h3>
                        <p>Sperăm să vă placă tot ceea ce comandați de la noi, 
                        dar nu vă faceți griji dacă ceva nu este în regulă, aveți 15 zile pentru a face retur.</p>
                        <p></p>
                        <p>Vă vom oferi o rambursare completă prin aceeași metodă pe care ați plătit-o și tot ceea ce solicităm este ca articolele să fie returnate curate,
                         neuzate și să aibă toate etichetele lor.</p>
                        <p>Cum faci retur:</p>
                        <ul>
                            <li>Articolele trebuie să fie în starea lor originală, cu toate etichetele 
                            încă atașate și vi se va cere să prezentați chitanța corespunzătoare.</li>
                            <li>Contactați-ne si spuneți-ne motivul pentru care faceți retur. 
                            Aveți 3 zile pentru a ne contacta cu privire la retur după ce ați primit produsele.</li>
                            <li>Împachetați hainele în cutia originală,
                             completați formularul de retur găsit în pachet și pregătiți pachetul pentru livrare.</li>
                            <li>Vă rugăm să rețineți că responsabilitatea financiară pentru returnare este a dvs. și va trebui să plătiți
                             pentru costul de transport retur. 
                            Contactați un curier la alegere pentru a ridica pachetul și trimiteți coletul la următoarea adresă:
                            Baia Mare, Str. Aviatorilor, nr. 3A, Județ Maramureș, România, mobil - (+40) 0721955639.</li>
                        </ul>
                        
                        <p>*Produsele returnate care nu sunt într-o condiție buna pentru a fi vândute, nu vor fi rambursate și vă pot fi trimise înapoi.</p>
                        <p>Schimbarea produsului:</p>
                        <p>Dacă doriți să schimbați un articol, puteți solicita o returnare și să plasați o nouă comandă online.</p>
                    <h3>Rambursarea banilor:</h3>
                        <p>După ce produsul returnat de dvs. a ajuns la noi, veți primi o rambursare completă în termen de 15 zile
                         prin aceleași mijloace utilizate pentru efectuarea achiziției. Odată ce returnarea a fost aprobată 
                         (articolele trebuie să fie în stare perfectă și etichetele interne trebuie să fie intacte),
                          veți primi un e-mail de confirmare care indică faptul că rambursarea va fi plătită în contul dvs. în câteva zile.
                         Nu uitați că plățile către cardul dvs. de credit depind întotdeauna de societatea bănci dumneavoastră.</p>
            
            
            </div>
        </div>
        <div class="go_to">
            <ul>
                <li>Politica de confidentialitate:</li>
                <li>Serviciu Clienți:</li>
                <li>Plată</li>
                <li>Livrare</li>
                <li>Retur</li>
            </ul>
            <img class="buton"src="./images/arrowRight.png">
        </div>
        <script>
            var goTo = document.querySelector(".go_to");
            var buton = document.querySelector(".buton");
            var w = document.documentElement.clientWidth;
            console.dir(goTo);
            function hide(){
                if (w <= 1250){
                    goTo.firstElementChild.style.display="none";
                    goTo.style.width="30px";
                    goTo.lastElementChild.style.transform="rotate(0deg)";
                }
                else { goTo.firstElementChild.style.display="block";
                    goTo.style.width="200px";
                    goTo.lastElementChild.style.transform="rotate(-180deg)";}
            }
            window.addEventListener("resize", function(){
                var new_w = document.documentElement.clientWidth;
                if (new_w <= 1250){
                    goTo.firstElementChild.style.display="none";
                    goTo.style.width="30px";
                    goTo.lastElementChild.style.transform="rotate(0deg)";
                }
                else { goTo.firstElementChild.style.display="block";
                    goTo.style.width="200px";
                    goTo.lastElementChild.style.transform="rotate(-180deg)";}
            });
            var ok=0;
            buton.addEventListener("click", function(){
                if((goTo.clientWidth == "30") && (ok==0)){
                    goTo.firstElementChild.style.display="block";
                    goTo.style.width="200px";
                    goTo.lastElementChild.style.transform="rotate(-180deg)";
                    ok=1;
                }
                else {
                    goTo.firstElementChild.style.display="none";
                    goTo.style.width="30px";
                    goTo.lastElementChild.style.transform="rotate(0deg)";
                    ok=0;
                }
            });
            //scroll to
            //functie care imi gaseste distanta pt scroll
            function offset(el) {
            var rect = el.getBoundingClientRect(),
            scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
            scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            return { top: rect.top + scrollTop, left: rect.left + scrollLeft }
            }
            var ancor_conf = document.querySelector(".ancor1");
            var ancor_serv = document.querySelector(".ancor2");
            var ancor_plata = document.querySelector(".ancor3");
            var ancor_livrare = document.querySelector(".ancor4");
            var ancor_retur = document.querySelector(".ancor5");
            //console.log(d_conf.top);
            


            //end
            var lista = new Array(goTo.firstElementChild.children);
            var goTo_servicii = lista[0][1];
            var goTo_plata = lista[0][2];
            var goTo_livrare = lista[0][3];
            var goTo_retur = lista[0][4];
            var goTo_conf = lista[0][0];
            // 
            

            goTo_servicii.addEventListener("click", function(){
                window.scrollTo(0,(offset(ancor_serv).top-110));
            });
            goTo_plata.addEventListener("click", function(){
                window.scrollTo(0,(offset(ancor_plata).top-110));
            });
            goTo_livrare.addEventListener("click", function(){
                window.scrollTo(0,(offset(ancor_livrare).top-110));
            });
            goTo_conf.addEventListener("click", function(){
                window.scrollTo(0,(offset(ancor_conf).top)-110);
            });
            goTo_retur.addEventListener("click", function(){
                window.scrollTo(0,(offset(ancor_retur).top-110));
            });
        </script>
        <div class="bottom-tag">
            <div class='bottom-box'>
                <ul>
                    <li><a href='./index.php'>Acasă</a></li>
                    <li><a href='./shop.php'>Magazin</a></li>
                    <li><a href='./info-page.php'>Informații</a></li>
                    <li><a href='./info-page.php'>Termeni și conditii</a></li>
                </ul>
                <ul>
                    <li><a href='./info-page.php'>Metode de plată</a></li>
                    <li><a href='./info-page.php'>Informații retur</a></li>
                    <li><a href='https://anpc.ro/'>ANPC</a></li>
                </ul>
                <ul>
                <li ><a href='https://www.facebook.com/pg/croitoriecomada'><img style='height:25px;' src='./images/f_logo_RGB-White_58.png'></a></li>
                </ul>
            </div>
            <p style="margin-bottom: 30px;"><img style="width: 70%;max-width: 700px;" src="./images/eu_platescImg.jpg" alt=""></p>
            <p style="margin: 15px; margin-bottom: 50px;">Contact - Telefon: (+40) 0767660498 sau (+40) 0721955639, E-mail: office@belissimadesign.com</p>
            <p>Copyright © 2019 belissima-design . Toate drepturile rezervate.</p>
            <p>Web design by <a href='https://www.facebook.com/ianos.calin'>Ianoș Călin</a></p>
        </div>
        <script type="text/javascript" src="./JS/menu.js"></script>
        <script type="text/javascript" src="./JS/img_hoverChange.js"></script>
    </body>