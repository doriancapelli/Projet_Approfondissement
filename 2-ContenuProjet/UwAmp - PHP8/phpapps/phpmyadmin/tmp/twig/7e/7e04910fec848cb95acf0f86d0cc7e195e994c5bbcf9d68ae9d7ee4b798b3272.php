<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* preferences/two_factor/configure.twig */
class __TwigTemplate_250832f49e76b68c12ea8666d56531ace8a13153a429208900e15fe8025c95c0 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<div class=\"group\">
<h2>";
        // line 2
        echo _gettext("Configure two-factor authentication");
        echo "</h2>
<div class=\"group-cnt\">
<form method=\"POST\" action=\"prefs_twofactor.php\">
";
        // line 5
        echo PhpMyAdmin\Url::getHiddenInputs();
        echo "
<input type=\"hidden\" name=\"2fa_configure\" value=\"";
        // line 6
        echo twig_escape_filter($this->env, ($context["configure"] ?? null), "html", null, true);
        echo "\">
";
        // line 7
        echo ($context["form"] ?? null);
        echo "
<input class=\"btn btn-secondary\" type=\"submit\" value=\"";
        // line 8
        echo _gettext("Enable two-factor authentication");
        echo "\">
</form>
</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "preferences/two_factor/configure.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  58 => 8,  54 => 7,  50 => 6,  46 => 5,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "preferences/two_factor/configure.twig", "F:\\WWW\\UwAmp - PHP8\\phpapps\\phpmyadmin\\templates\\preferences\\two_factor\\configure.twig");
    }
}
