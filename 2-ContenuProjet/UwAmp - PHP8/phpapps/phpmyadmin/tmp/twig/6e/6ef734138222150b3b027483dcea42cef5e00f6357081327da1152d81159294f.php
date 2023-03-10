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

/* table/tracking/main.twig */
class __TwigTemplate_d2f0518f254d78d1fb3443ed5a70c284e8ba7062c0762b3ee3bb94b76b70530f extends \Twig\Template
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
        if ((($context["selectable_tables_num_rows"] ?? null) > 0)) {
            // line 2
            echo "    <form method=\"post\" action=\"tbl_tracking.php";
            echo ($context["url_query"] ?? null);
            echo "\">
        ";
            // line 3
            echo PhpMyAdmin\Url::getHiddenInputs(($context["db"] ?? null), ($context["table"] ?? null));
            echo "
        <select name=\"table\" class=\"autosubmit\">
            ";
            // line 5
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["selectable_tables_entries"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["entry"]) {
                // line 6
                echo "                <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["entry"], "table_name", [], "any", false, false, false, 6), "html", null, true);
                echo "\"";
                // line 7
                echo (((twig_get_attribute($this->env, $this->source, $context["entry"], "table_name", [], "any", false, false, false, 7) == ($context["selected_table"] ?? null))) ? (" selected") : (""));
                echo ">
                    ";
                // line 8
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["entry"], "db_name", [], "any", false, false, false, 8), "html", null, true);
                echo ".";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["entry"], "table_name", [], "any", false, false, false, 8), "html", null, true);
                echo "
                    ";
                // line 9
                if (twig_get_attribute($this->env, $this->source, $context["entry"], "is_tracked", [], "any", false, false, false, 9)) {
                    // line 10
                    echo "                        (";
                    echo _gettext("active");
                    echo ")
                    ";
                } else {
                    // line 12
                    echo "                        (";
                    echo _gettext("not active");
                    echo ")
                    ";
                }
                // line 14
                echo "                </option>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['entry'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 16
            echo "        </select>
        <input type=\"hidden\" name=\"show_versions_submit\" value=\"1\">
    </form>
";
        }
        // line 20
        echo "<br>
";
        // line 21
        if ((($context["last_version"] ?? null) > 0)) {
            // line 22
            echo "    <form method=\"post\" action=\"tbl_tracking.php\" name=\"versionsForm\" id=\"versionsForm\" class=\"ajax\">
        ";
            // line 23
            echo PhpMyAdmin\Url::getHiddenInputs(($context["db"] ?? null), ($context["table"] ?? null));
            echo "
        <table id=\"versions\" class=\"data\">
            <thead>
                <tr>
                    <th></th>
                    <th>";
            // line 28
            echo _gettext("Version");
            echo "</th>
                    <th>";
            // line 29
            echo _gettext("Created");
            echo "</th>
                    <th>";
            // line 30
            echo _gettext("Updated");
            echo "</th>
                    <th>";
            // line 31
            echo _gettext("Status");
            echo "</th>
                    <th>";
            // line 32
            echo _gettext("Action");
            echo "</th>
                    <th>";
            // line 33
            echo _gettext("Show");
            echo "</th>
                </tr>
            </thead>
            <tbody>
                ";
            // line 37
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["versions"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["version"]) {
                // line 38
                echo "                    <tr>
                        <td class=\"center\">
                            <input type=\"checkbox\" name=\"selected_versions[]\"
                                class=\"checkall\" id=\"selected_versions_";
                // line 41
                echo twig_escape_filter($this->env, (($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = $context["version"]) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4["version"] ?? null) : null));
                echo "\"
                                value=\"";
                // line 42
                echo twig_escape_filter($this->env, (($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = $context["version"]) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144["version"] ?? null) : null));
                echo "\">
                        </td>
                        <td class=\"floatright\">
                            <label for=\"selected_versions_";
                // line 45
                echo twig_escape_filter($this->env, (($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b = $context["version"]) && is_array($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b) || $__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b instanceof ArrayAccess ? ($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b["version"] ?? null) : null));
                echo "\">
                                <b>";
                // line 46
                echo twig_escape_filter($this->env, (($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 = $context["version"]) && is_array($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002) || $__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 instanceof ArrayAccess ? ($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002["version"] ?? null) : null));
                echo "</b>
                            </label>
                        </td>
                        <td>";
                // line 49
                echo twig_escape_filter($this->env, (($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 = $context["version"]) && is_array($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4) || $__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 instanceof ArrayAccess ? ($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4["date_created"] ?? null) : null));
                echo "</td>
                        <td>";
                // line 50
                echo twig_escape_filter($this->env, (($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 = $context["version"]) && is_array($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666) || $__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 instanceof ArrayAccess ? ($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666["date_updated"] ?? null) : null));
                echo "</td>
                        ";
                // line 51
                if (((($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e = $context["version"]) && is_array($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e) || $__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e instanceof ArrayAccess ? ($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e["tracking_active"] ?? null) : null) == 1)) {
                    // line 52
                    echo "                            ";
                    $context["last_version_status"] = 1;
                    // line 53
                    echo "                            <td>";
                    echo _gettext("active");
                    echo "</td>
                        ";
                } else {
                    // line 55
                    echo "                            ";
                    $context["last_version_status"] = 0;
                    // line 56
                    echo "                            <td>";
                    echo _gettext("not active");
                    echo "</td>
                        ";
                }
                // line 58
                echo "                        <td>
                            <a class=\"delete_version_anchor ajax\" href=\"tbl_tracking.php\" data-post=\"";
                // line 60
                echo PhpMyAdmin\Url::getCommon(twig_array_merge(($context["url_params"] ?? null), ["version" => (($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 =                 // line 61
$context["version"]) && is_array($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52) || $__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 instanceof ArrayAccess ? ($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52["version"] ?? null) : null), "submit_delete_version" => true]), "");
                // line 63
                echo "\">
                                ";
                // line 64
                echo PhpMyAdmin\Util::getIcon("b_drop", _gettext("Delete version"));
                echo "
                            </a>
                        </td>
                        <td>
                            <a href=\"tbl_tracking.php\" data-post=\"";
                // line 69
                echo PhpMyAdmin\Url::getCommon(twig_array_merge(($context["url_params"] ?? null), ["version" => (($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136 =                 // line 70
$context["version"]) && is_array($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136) || $__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136 instanceof ArrayAccess ? ($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136["version"] ?? null) : null), "report" => "true"]), "");
                // line 72
                echo "\">
                                ";
                // line 73
                echo PhpMyAdmin\Util::getIcon("b_report", _gettext("Tracking report"));
                echo "
                            </a>
                            <a href=\"tbl_tracking.php\" data-post=\"";
                // line 76
                echo PhpMyAdmin\Url::getCommon(twig_array_merge(($context["url_params"] ?? null), ["version" => (($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 =                 // line 77
$context["version"]) && is_array($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386) || $__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 instanceof ArrayAccess ? ($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386["version"] ?? null) : null), "snapshot" => "true"]), "");
                // line 79
                echo "\">
                                ";
                // line 80
                echo PhpMyAdmin\Util::getIcon("b_props", _gettext("Structure snapshot"));
                echo "
                            </a>
                        </td>
                    </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['version'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 85
            echo "            </tbody>
        </table>
        ";
            // line 87
            $this->loadTemplate("select_all.twig", "table/tracking/main.twig", 87)->display(twig_to_array(["pma_theme_image" =>             // line 88
($context["pmaThemeImage"] ?? null), "text_dir" =>             // line 89
($context["text_dir"] ?? null), "form_name" => "versionsForm"]));
            // line 92
            echo "        ";
            echo PhpMyAdmin\Util::getButtonOrImage("submit_mult", "mult_submit", _gettext("Delete version"), "b_drop", "delete_version");
            // line 98
            echo "
    </form>
    ";
            // line 100
            $context["last_version_element"] = twig_first($this->env, ($context["versions"] ?? null));
            // line 101
            echo "    <div>
        <form method=\"post\" action=\"tbl_tracking.php";
            // line 102
            echo ($context["url_query"] ?? null);
            echo "\">
            ";
            // line 103
            echo PhpMyAdmin\Url::getHiddenInputs(($context["db"] ?? null), ($context["table"] ?? null));
            echo "
            <fieldset>
                <legend>
                    ";
            // line 106
            if (((($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9 = ($context["last_version_element"] ?? null)) && is_array($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9) || $__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9 instanceof ArrayAccess ? ($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9["tracking_active"] ?? null) : null) == 0)) {
                // line 107
                echo "                        ";
                $context["legend"] = _gettext("Activate tracking for %s");
                // line 108
                echo "                        ";
                $context["value"] = "activate_now";
                // line 109
                echo "                        ";
                $context["button"] = _gettext("Activate now");
                // line 110
                echo "                    ";
            } else {
                // line 111
                echo "                        ";
                $context["legend"] = _gettext("Deactivate tracking for %s");
                // line 112
                echo "                        ";
                $context["value"] = "deactivate_now";
                // line 113
                echo "                        ";
                $context["button"] = _gettext("Deactivate now");
                // line 114
                echo "                    ";
            }
            // line 115
            echo "
                    ";
            // line 116
            echo twig_escape_filter($this->env, sprintf(($context["legend"] ?? null), ((($context["db"] ?? null) . ".") . ($context["table"] ?? null))), "html", null, true);
            echo "
                </legend>
                <input type=\"hidden\" name=\"version\" value=\"";
            // line 118
            echo twig_escape_filter($this->env, ($context["last_version"] ?? null), "html", null, true);
            echo "\">
                <input type=\"hidden\" name=\"toggle_activation\" value=\"";
            // line 119
            echo twig_escape_filter($this->env, ($context["value"] ?? null), "html", null, true);
            echo "\">
                <input class=\"btn btn-secondary\" type=\"submit\" value=\"";
            // line 120
            echo twig_escape_filter($this->env, ($context["button"] ?? null), "html", null, true);
            echo "\">
            </fieldset>
        </form>
    </div>
";
        }
        // line 125
        $this->loadTemplate("create_tracking_version.twig", "table/tracking/main.twig", 125)->display(twig_to_array(["url_query" =>         // line 126
($context["url_query"] ?? null), "last_version" =>         // line 127
($context["last_version"] ?? null), "db" =>         // line 128
($context["db"] ?? null), "selected" => [0 =>         // line 129
($context["table"] ?? null)], "type" =>         // line 130
($context["type"] ?? null), "default_statements" =>         // line 131
($context["default_statements"] ?? null)]));
    }

    public function getTemplateName()
    {
        return "table/tracking/main.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  324 => 131,  323 => 130,  322 => 129,  321 => 128,  320 => 127,  319 => 126,  318 => 125,  310 => 120,  306 => 119,  302 => 118,  297 => 116,  294 => 115,  291 => 114,  288 => 113,  285 => 112,  282 => 111,  279 => 110,  276 => 109,  273 => 108,  270 => 107,  268 => 106,  262 => 103,  258 => 102,  255 => 101,  253 => 100,  249 => 98,  246 => 92,  244 => 89,  243 => 88,  242 => 87,  238 => 85,  227 => 80,  224 => 79,  222 => 77,  221 => 76,  216 => 73,  213 => 72,  211 => 70,  210 => 69,  203 => 64,  200 => 63,  198 => 61,  197 => 60,  194 => 58,  188 => 56,  185 => 55,  179 => 53,  176 => 52,  174 => 51,  170 => 50,  166 => 49,  160 => 46,  156 => 45,  150 => 42,  146 => 41,  141 => 38,  137 => 37,  130 => 33,  126 => 32,  122 => 31,  118 => 30,  114 => 29,  110 => 28,  102 => 23,  99 => 22,  97 => 21,  94 => 20,  88 => 16,  81 => 14,  75 => 12,  69 => 10,  67 => 9,  61 => 8,  57 => 7,  53 => 6,  49 => 5,  44 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "table/tracking/main.twig", "F:\\WWW\\UwAmp - PHP8\\phpapps\\phpmyadmin\\templates\\table\\tracking\\main.twig");
    }
}
