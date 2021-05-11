# Mathplus

[English](https://github.com/StarsRivers/FlaJax/blob/main/README.md)
 或
[简体中文](https://github.com/StarsRivers/FlaJax/blob/main/READMECN.md)

[包装专家](https://packagist.org/packages/starsriver/mathplus)

1.安装Mathplus插件
```
composer require starsriver/mathplus
```
2.在Flarum管理面板中启用插件

3.编写数学时，请遵循以下规则：
*只需将内联数学公式包含在单个美元符号中 $ ... $
*或在单独的行中使用双美元符号表示公式
```
$$
...
$$
```
* 为了枚举方程，使用
```
$$
\begin{equation}
...
\label{eqEmc}
\end[equation}
$$
```
这样，就可以通过使用Eq来引用它。`\ref{eqEmc}`.
将{}与上标一起使用：`E=mc^{2}`如果您希望LaTeX正确处理上标。
### [Include社区](https://include.uotan.cn)
