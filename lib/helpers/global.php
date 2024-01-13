<?php
if (! function_exists('d')) {
    /**
     * Render a node in the tree-view for the dumped variable.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @param  int  $level
     * @return string
     * @author sharif developersharif@yahoo.com
     */
    function renderNode($key, $value, $level = 0) {
        $output = '';

        // Indentation for better visualization
        $indentation = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level);

        if (is_array($value)) {
            $output .= "$indentation<strong class='sf-dump-key'>Array $key:</strong> ";
            $output .= '<span class="toggle-button" onclick="toggleNode(this)">&#9658;</span>';
            $output .= '<div class="tree-node" style="display: none;">';

            foreach ($value as $subKey => $subValue) {
                $output .= renderNode($subKey, $subValue, $level + 1);
            }

            $output .= '</div>';
        } elseif (is_object($value)) {
            $output .= "$indentation<strong class='sf-dump-key'>Object $key:</strong> ";
            $output .= '<span class="toggle-button" onclick="toggleNode(this)">&#9658;</span>';
            $output .= '<div class="tree-node" style="display: none;">';

            foreach ((array)$value as $subKey => $subValue) {
                $output .= renderNode($subKey, $subValue, $level + 1);
            }

            $output .= '</div>';
        } else {
            $output .= "$indentation<strong class='sf-dump-key'>$key:</strong> " . formatValue($value) . "<br>";
        }

        return $output;
    }

    /**
     * Format the value for display in the tree-view.
     *
     * @param  mixed  $value
     * @return string
     */
    function formatValue($value) {
        if (is_string($value)) {
            return "<span class='sf-dump-str'>\"$value\"</span>";
        } elseif (is_bool($value)) {
            return "<span class='sf-dump-bool'>" . ($value ? "true" : "false") . "</span>";
        } elseif (is_null($value)) {
            return "<span class='sf-dump-null'>null</span>";
        } else {
            return "<span class='sf-dump-num'>$value</span>";
        }
    }

        /**
     * Dump variable content in a visually appealing tree-view format.
     *
     * @param  mixed  $variable
     * @return string
     */
    function d($variable) {
        $output = '<div class="sf-dump tree-view">';
        $output .= renderNode('Root', $variable);
        $output .= '</div>';

        $output .= '<script>
            function toggleNode(button) {
                var node = button.nextElementSibling;
                node.style.display = node.style.display === "none" ? "block" : "none";
                button.innerHTML = node.style.display === "none" ? "&#9658;" : "&#9660;";
            }

            // Collapse all nodes by default
            var toggleButtons = document.querySelectorAll(".toggle-button");
            toggleButtons.forEach(function(button) {
                var node = button.nextElementSibling;
                node.style.display = "none";
                button.innerHTML = "&#9658;";
            });
        </script>';

        $output .= '<style>
            .tree-view { font-family: SFMono-Regular, Consolas, Liberation Mono, Menlo, monospace; }
            .toggle-button { cursor: pointer; }
            .tree-node { margin-left: 20px; }
            .sf-dump { color: #575757; background: #f3f3f3; padding: 8px; border-radius: 4px; font-size: 13px; line-height: 1.4; }
            .sf-dump-key { color: #737373; }
            .sf-dump-str { color: #183691; }
            .sf-dump-bool { color: #008000; }
            .sf-dump-null { color: #008080; }
            .sf-dump-num { color: #d44a4a; }
        </style>';

        return "<pre>".$output."</pre>";
    }
}