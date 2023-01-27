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

/* login/twofactor/application_configure.twig */
class __TwigTemplate_aba228022f08d9359cd677dbb034fbe17d30ffe6522b68a9a8febc4116c23983 extends \Twig\Template
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
        echo PhpMyAdmin\Url::getHiddenInputs();
        echo "
<p>
    ";
        // line 3
        echo _gettext("Please scan following QR code into the two-factor authentication app on your device and enter authentication code it generates.");
        // line 4
        echo "</p>
<p>
    ";
        // line 6
        if (($context["has_imagick"] ?? null)) {
            // line 7
            echo "        <img src=\"";
            echo twig_escape_filter($this->env, ($context["image"] ?? null), "html", null, true);
            echo "\">
    ";
        } else {
            // line 9
            echo "        ";
            echo ($context["image"] ?? null);
            echo "
    ";
        }
        // line 11
        echo "</p>
<p>
    ";
        // line 13
        echo _gettext("Secret/key:");
        echo " <strong>";
        echo twig_escape_filter($this->env, ($context["secret"] ?? null), "html", null, true);
        echo "</strong>
</p>
<p>
    <label>";
        // line 16
        echo _gettext("Authentication code:");
        echo " <input type=\"text\" name=\"2fa_code\" autocomplete=\"off\"></label>
</p>
";
    }

    public function getTemplateName()
    {
        return "login/twofactor/application_configure.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  74 => 16,  66 => 13,  62 => 11,  56 => 9,  50 => 7,  48 => 6,  44 => 4,  42 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "login/twofactor/application_configure.twig", "F:\\WWW\\UwAmp - PHP8\\phpapps\\phpmyadmin\\templates\\login\\twofactor\\application_configure.twig");
    }
}
