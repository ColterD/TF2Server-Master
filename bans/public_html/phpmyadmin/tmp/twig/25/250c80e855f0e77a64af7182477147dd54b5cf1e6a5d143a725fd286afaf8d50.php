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

/* server/variables/index.twig */
class __TwigTemplate_849d6bd67fb01c4c1a8ec98243069c660e5592e05ad3528e36fe6681ef26ffa3 extends \Twig\Template
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
        echo "<h2>
  ";
        // line 2
        echo PhpMyAdmin\Util::getImage("s_vars");
        echo "
  ";
        // line 3
        echo _gettext("Server variables and settings");
        // line 4
        echo "  ";
        echo PhpMyAdmin\Util::showMySQLDocu("server_system_variables");
        echo "
</h2>

";
        // line 7
        if ( !twig_test_empty(($context["variables"] ?? null))) {
            // line 8
            echo "  <a href=\"server_variables.php";
            echo PhpMyAdmin\Url::getCommon();
            echo "\" class=\"ajax saveLink hide\">
    ";
            // line 9
            echo PhpMyAdmin\Util::getIcon("b_save", _gettext("Save"));
            echo "
  </a>
  <a href=\"#\" class=\"cancelLink hide\">
    ";
            // line 12
            echo PhpMyAdmin\Util::getIcon("b_close", _gettext("Cancel"));
            echo "
  </a>
  ";
            // line 14
            echo PhpMyAdmin\Util::getImage("b_help", _gettext("Documentation"), ["class" => "hide", "id" => "docImage"]);
            // line 17
            echo "

  ";
            // line 19
            $this->loadTemplate("filter.twig", "server/variables/index.twig", 19)->display(twig_to_array(["filter_value" =>             // line 20
($context["filter_value"] ?? null)]));
            // line 22
            echo "
  <div class=\"responsivetable\">
    <table id=\"serverVariables\" class=\"width100 data filteredData noclick\">
      <thead>
        <tr class=\"var-header var-row\">
          <td class=\"var-action\">";
            // line 27
            echo _gettext("Action");
            echo "</td>
          <td class=\"var-name\">";
            // line 28
            echo _gettext("Variable");
            echo "</td>
          <td class=\"var-value\">";
            // line 29
            echo _gettext("Value");
            echo "</td>
        </tr>
      </thead>

      <tbody>
        ";
            // line 34
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["variables"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["variable"]) {
                // line 35
                echo "          <tr class=\"var-row";
                echo ((twig_get_attribute($this->env, $this->source, $context["variable"], "has_session_value", [], "any", false, false, false, 35)) ? (" diffSession") : (""));
                echo "\" data-filter-row=\"";
                echo twig_escape_filter($this->env, twig_upper_filter($this->env, twig_get_attribute($this->env, $this->source, $context["variable"], "name", [], "any", false, false, false, 35)), "html", null, true);
                echo "\">
            <td class=\"var-action\">
              ";
                // line 37
                if (twig_get_attribute($this->env, $this->source, $context["variable"], "is_editable", [], "any", false, false, false, 37)) {
                    // line 38
                    echo "                <a href=\"#\" data-variable=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["variable"], "name", [], "any", false, false, false, 38), "html", null, true);
                    echo "\" class=\"editLink\">";
                    echo PhpMyAdmin\Util::getIcon("b_edit", _gettext("Edit"));
                    echo "</a>
              ";
                } else {
                    // line 40
                    echo "                <span title=\"";
                    echo _gettext("This is a read-only variable and can not be edited");
                    echo "\" class=\"read_only_var\">
                  ";
                    // line 41
                    echo PhpMyAdmin\Util::getIcon("bd_edit", _gettext("Edit"));
                    echo "
                </span>
              ";
                }
                // line 44
                echo "            </td>
            <td class=\"var-name\">
              ";
                // line 46
                if ((twig_get_attribute($this->env, $this->source, $context["variable"], "doc_link", [], "any", false, false, false, 46) != null)) {
                    // line 47
                    echo "                <span title=\"";
                    echo twig_escape_filter($this->env, twig_replace_filter(twig_get_attribute($this->env, $this->source, $context["variable"], "name", [], "any", false, false, false, 47), ["_" => " "]), "html", null, true);
                    echo "\">
                  ";
                    // line 48
                    echo twig_get_attribute($this->env, $this->source, $context["variable"], "doc_link", [], "any", false, false, false, 48);
                    echo "
                </span>
              ";
                } else {
                    // line 51
                    echo "                ";
                    echo twig_escape_filter($this->env, twig_replace_filter(twig_get_attribute($this->env, $this->source, $context["variable"], "name", [], "any", false, false, false, 51), ["_" => " "]), "html", null, true);
                    echo "
              ";
                }
                // line 53
                echo "            </td>
            <td class=\"var-value value";
                // line 54
                echo ((($context["is_superuser"] ?? null)) ? (" editable") : (""));
                echo "\">
              ";
                // line 55
                if (twig_get_attribute($this->env, $this->source, $context["variable"], "is_escaped", [], "any", false, false, false, 55)) {
                    // line 56
                    echo "                ";
                    echo twig_get_attribute($this->env, $this->source, $context["variable"], "value", [], "any", false, false, false, 56);
                    echo "
              ";
                } else {
                    // line 58
                    echo "                ";
                    echo twig_replace_filter(twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["variable"], "value", [], "any", false, false, false, 58)), ["," => ",&#8203;"]);
                    echo "
              ";
                }
                // line 60
                echo "            </td>
          </tr>

          ";
                // line 63
                if (twig_get_attribute($this->env, $this->source, $context["variable"], "has_session_value", [], "any", false, false, false, 63)) {
                    // line 64
                    echo "            <tr class=\"var-row diffSession\" data-filter-row=\"";
                    echo twig_escape_filter($this->env, twig_upper_filter($this->env, twig_get_attribute($this->env, $this->source, $context["variable"], "name", [], "any", false, false, false, 64)), "html", null, true);
                    echo "\">
              <td class=\"var-action\"></td>
              <td class=\"var-name session\">(";
                    // line 66
                    echo _gettext("Session value");
                    echo ")</td>
              <td class=\"var-value value\">";
                    // line 67
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["variable"], "session_value", [], "any", false, false, false, 67), "html", null, true);
                    echo "</td>
            </tr>
          ";
                }
                // line 70
                echo "        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['variable'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 71
            echo "      </tbody>
    </table>
  </div>
";
        } else {
            // line 75
            echo "  ";
            echo call_user_func_array($this->env->getFilter('error')->getCallable(), [sprintf(_gettext("Not enough privilege to view server variables and settings. %s"), PhpMyAdmin\Util::linkToVarDocumentation("show_compatibility_56",             // line 76
($context["is_mariadb"] ?? null)))]);
            // line 77
            echo "
";
        }
    }

    public function getTemplateName()
    {
        return "server/variables/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  219 => 77,  217 => 76,  215 => 75,  209 => 71,  203 => 70,  197 => 67,  193 => 66,  187 => 64,  185 => 63,  180 => 60,  174 => 58,  168 => 56,  166 => 55,  162 => 54,  159 => 53,  153 => 51,  147 => 48,  142 => 47,  140 => 46,  136 => 44,  130 => 41,  125 => 40,  117 => 38,  115 => 37,  107 => 35,  103 => 34,  95 => 29,  91 => 28,  87 => 27,  80 => 22,  78 => 20,  77 => 19,  73 => 17,  71 => 14,  66 => 12,  60 => 9,  55 => 8,  53 => 7,  46 => 4,  44 => 3,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "server/variables/index.twig", "/home/bans/public_html/phpmyadmin/templates/server/variables/index.twig");
    }
}
