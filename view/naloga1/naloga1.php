<div id="game-container">
    <div id="terminal">
        <div id="terminal-header">
            <span class="terminal-title">Eksperiment 67-A</span>
        </div>
        <div id="terminal-output"></div>
        <div id="terminal-input-line">
            <span class="prompt">&gt;</span>
            <input type="text" id="terminal-input" autocomplete="off" spellcheck="false">
        </div>
    </div>
</div>
<br><br><br><br><br><br><br><br>
<div id="original-code-section">
    <button id="toggle-code-btn" onclick="toggleOriginalCode()">Prikaži originalno kodo</button>
    <div id="original-code-content" style="display: none;">
        <pre><code>@echo off
color 0A
title Eksperiment 67-A
@chcp 65001 >nul

:: Inventar
set "ima_prvo_stevilko=0"
set "ima_drugo_stevilko=0"
set "ima_tretjo_stevilko=0"

:: Začetna lokacija
set "lokacija=laboratorij"

echo Dobrodošel/la v igro.
echo Zbudiš se v temnem, hladnem laboratoriju.
echo Luči utripajo, zrak smrdi po kemikalijah. Nespomniš se, kdo si in zakaj si tu.
echo Pred tabo je računalnik, na katerem piše:"Eksperiment 67-A aktiviran."
echo Navodila: Za izhod potrebuješ 3 številke.
echo Ko obiščeš vse tri sobe in najdeš vse stevilke izberi Imam vse.

pause
:navodilo
cls
echo. 
echo    Eksperiment 67-A
echo. 
echo.
echo Zbudiš se v temnem laboratoriju.
echo Pred tabo so troja vrata: rdeca, modra in siva.
echo Tvoj cilj je najti 3 številke in vnesti kodo.
echo.
echo NAVODILA:
echo Premik: vnesi "[vrata]"  (rdeča, modra, siva)
echo Pobiranje: vnesi "poberi [predmet]" (številka)
echo Inventar: vnesi "inventar"
echo Ko imaš vse 3 številke: vnesi "imam vse"
echo.
pause
goto zacetek

:zacetek
cls
echo Navodila:
echo Premik: vnesi "[vrata]"  (rdeca, modra, siva)
echo Pobiranje: vnesi "poberi [predmet]" (številka)
echo Inventar: vnesi "inventar"
echo Ko imaš vse 3 številke: vnesi "imam vse"
echo ----------------------------------------------
echo.

echo Trenutno si v: %lokacija%
echo.
set /p "ukaz=> "

:: Premikanje skozi vrata
if /i "%ukaz%"=="rdeca" goto rdeca
if /i "%ukaz%"=="modra" goto modra
if /i "%ukaz%"=="siva" goto siva

:: Inventar
if /i "%ukaz%"=="inventar" (
    echo Imaš:
    if %ima_prvo_stevilko%==1 echo - Prva številka je 4
    if %ima_drugo_stevilko%==1 echo - Druga številka je 7
    if %ima_tretjo_stevilko%==1 echo - Tretja številka je 2
    pause
    goto zacetek
)

if /i "%ukaz%"=="imam vse" goto kodiranje

echo Neznan ukaz. Poskusi znova.
pause
goto zacetek

:rdeca
cls
echo Vstopiš v prostor in vidiš, kako utripa rdeča luč.
echo Na mizi je zvezek.
echo V zvezku piše: Samo prava koda ustavi sistem.
echo Spodaj, pa komaj vidno piše: PI na dve decimalki.
set "lokacija=rdeca vrata"

set correct=3.14
set /p answer=
if "%answer%"=="%correct%" (
    echo BRAVOOOOO odgovor je pravilen. Prva številka je 4.
    set "ima_prvo_stevilko=1"
) else (
    echo Narobe si odgovoril. Poskusi znova kasneje.
)
pause
goto zacetek



:modra
cls
echo Za vrati je soba polna računalnikov.
echo En zaslon še deluje.
echo Na njem piše: Samo znanje te lahko reši.
echo Katero je glavno mesto Moldavije?
set correct=kisinjev
set /p answer=
if "%answer%"=="%correct%" (
    echo BRAVOOOOO odgovor je pravilen. Druga številka je 7.
    set "ima_drugo_stevilko=1"
) else (
    echo Narobe si odgovoril. Poskusi znova kasneje.
)
set "lokacija=modra vrata"
pause
goto zacetek
cls

:siva
cls
echo Za vrati te pričaka dolg,temen hodnik.
echo Na koncu hodnika se vidi kovinski sef.
echo Poleg njega pa sta dve stikali.
echo Rdeče 
echo Zeleno
echo Izberi stikalo
set /p choice=

if "%choice%"=="zeleno" (
    echo Sef se odpre.
    echo Zadnja številka je 7.
    set "ima_tretjo_stevilko=1"
) else if "%choice%"=="rdece" (
    goto rdece
) else (
    echo Hodnik postane strašen, bolje da se vrneš.
)

:rdece
cls
echo Svetloba se kar naenkrat spremeni vidiš le malo svetlobe
echo na koncu rdečega hodnika.
echo Ali si upaš razskirati vse kar imaš in iti naprej?
echo Grem naprej
echo Grem nazaj na varno
echo Izberi:
set /p choice=
if "%choice%"=="Grem naprej" (
	type konec_igre2.txt
	pause
	exit /d
) else if "%choice%"=="Grem nazaj na varno" (
	goto nazaj_siva
) else (
	echo Nauci se pravilno vpisovati ukaze
	pause
	goto zacetek
	cls
)

:nazaj_siva
echo Zelo pametno si se odločil
echo Prišel si nazaj do sivih vrat.
echo Ponovno si izberi stikalo.
echo Sedaj poskusiš pritisniti še zeleno stikalo.
pause
goto Zeleno

:zeleno
cls
echo Pritisnil si zeleno stikalo.
echo Sef se odpre in iz njega pade kovinska ploščica.
echo Na kateri piše "Zadnja številka je 2"
set "ima_tretjo_stevilko=1"
pause
goto zacetek

:kodiranje
echo Samo pravilna koda te lahko še reši.(vse številke napiši skupaj)
set /p choice=
if "%choice%"=="472" (
    goto zmaga
) else (
    call :konec_igre
)


:zmaga
echo Sonce ti osvetli obraz.
echo Zmagal si
echo BRAVOOOOOOOO
pause
exit /d

:konec_igre
echo.
type konec_igre2.txt
pause
exit /d</code></pre>
    </div>
</div>

