# Mathplus

[English](https://github.com/StarsRivers/FlaJax/blob/main/README.md)
 or 
[简体中文](https://github.com/StarsRivers/FlaJax/blob/main/READMECN.md)

[Packaginst](https://packagist.org/packages/starsriver/mathplus)

1. Install flarum plugin with:
```
composer require starsriver/mathplus
```

2. Enable plugin in flarum admin panel
3. Follow this rules when writing your math:

* Just enclose inline math formulas in single dollar signs `$ ... $`
* or use double dollar signs for formulas in a separate line
```
$$
...
$$
```
* In order to enumerate equations use
```
$$
\begin{equation}
...
\label{eqEmc}
\end[equation}
$$
```
* This way one can reference to it by using Eq. `\ref{eqEmc}`.
Use {} with superscript: `E=mc^{2}` if you want proper superscripts handling by LaTeX.

### [IncludeCommunity](https://include.uotan.cn)
