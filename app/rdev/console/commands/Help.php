<?php
/**
 * Copyright (C) 2015 David Young
 *
 * Defines the help command
 */
namespace RDev\Console\Commands;
use RDev\Console\Requests;
use RDev\Console\Responses;
use RDev\Console\Responses\Formatters;

class Help extends Command
{
    /** @var string The template for the output */
    private static $template = <<<EOF
-----------------------
Command: {{name}}
-----------------------
{{command}}

Description:
   {{description}}
Arguments:
{{arguments}}
Options:
{{options}}{{helpText}}
EOF;
    /** @var ICommand The command to help with */
    private $command = null;
    /** @var Formatters\Command The formatter that converts a command object to text */
    private $commandFormatter = null;
    /** @var Formatters\Padding The space padding formatter to use */
    private $spacePaddingFormatter  = null;

    /**
     * @param Formatters\Command $commandFormatter The formatter that converts a command object to text
     * @param Formatters\Padding $spacePaddingFormatter The space padding formatter to use
     */
    public function __construct(Formatters\Command $commandFormatter, Formatters\Padding $spacePaddingFormatter)
    {
        parent::__construct();

        $this->commandFormatter = $commandFormatter;
        $this->spacePaddingFormatter = $spacePaddingFormatter;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(Responses\IResponse $response)
    {
        if($this->command === null)
        {
            $response->writeln("Pass in the name of the command you'd like help with");
        }
        else
        {
            $descriptionText = "No description";
            $helpText = "";

            if($this->command->getDescription() != "")
            {
                $descriptionText = $this->command->getDescription();
            }

            if($this->command->getHelpText() != "")
            {
                $helpText = PHP_EOL . "Help:" . PHP_EOL . "   " . $this->command->getHelpText();
            }

            // Compile the template
            $compiledTemplate = self::$template;
            $compiledTemplate = str_replace("{{command}}", $this->commandFormatter->format($this->command), $compiledTemplate);
            $compiledTemplate = str_replace("{{description}}", $descriptionText, $compiledTemplate);
            $compiledTemplate = str_replace("{{name}}", $this->command->getName(), $compiledTemplate);
            $compiledTemplate = str_replace("{{arguments}}", $this->getArgumentText(), $compiledTemplate);
            $compiledTemplate = str_replace("{{options}}", $this->getOptionText(), $compiledTemplate);
            $compiledTemplate = str_replace("{{helpText}}", $helpText, $compiledTemplate);

            $response->writeln($compiledTemplate);
        }
    }

    /**
     * Sets the command to help with
     *
     * @param ICommand $command The command to help with
     */
    public function setCommand(ICommand $command)
    {
        $this->command = $command;
    }

    /**
     * {@inheritdoc}
     */
    protected function define()
    {
        $this->setName("help")
            ->setDescription("Displays information about a command")
            ->addArgument(new Requests\Argument(
                "command",
                Requests\ArgumentTypes::OPTIONAL,
                "The command to get help with"
            ));
    }

    /**
     * Converts the command arguments to text
     *
     * @return string The arguments as text
     */
    private function getArgumentText()
    {
        if(count($this->command->getArguments()) == 0)
        {
            return "No arguments";
        }

        $argumentTexts = [];

        foreach($this->command->getArguments() as $argument)
        {
            $argumentTexts[] = [$argument->getName(), " - " . $argument->getDescription()];
        }

        return $this->spacePaddingFormatter->format($argumentTexts, function($line)
        {
            return "   " . $line[0] . $line[1];
        });
    }

    /**
     * Gets the options as text
     *
     * @return string The options as text
     */
    private function getOptionText()
    {
        if(count($this->command->getOptions()) == 0)
        {
            return "No options";
        }

        $optionTexts = [];

        foreach($this->command->getOptions() as $option)
        {
            $optionTexts[] = [$this->getOptionsNames($option), " - " . $option->getDescription()];
        }

        return $this->spacePaddingFormatter->format($optionTexts, function($line)
        {
            return "   " . $line[0] . $line[1];
        });
    }

    /**
     * Gets the option names as a formatted string
     *
     * @param Requests\Option $option The option to convert to text
     * @return string The option names as text
     */
    private function getOptionsNames(Requests\Option $option)
    {
        $optionNames = "--{$option->getName()}";

        if($option->getShortName() !== null)
        {
            $optionNames .= "|-{$option->getShortName()}";
        }

        return $optionNames;
    }
}