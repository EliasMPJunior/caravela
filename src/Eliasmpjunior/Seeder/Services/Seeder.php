<?php

namespace Eliasmpjunior\Seeder\Services;

use Web64\Colors\Facades\Colors;

use Eliasmpjunior\Brasitable\Services\Brasitable;
use Eliasmpjunior\Brasitable\Contracts\BrasitableException;
use Eliasmpjunior\Seeder\Exceptions\TableShowErrorException;


class Seeder
{
	public static function printInfo()
	{
        $tableHeader = array(
                            array(
                                'title' => 'Data',
                                'color' => 'light_green',
                            ),
                            array(
                                'title' => 'Value',
                                'color' => 'light_green',
                            ),
                        );

        $tableContent = array(
                            array(
                                'Name',
                                'eliasmpjunior/seeder'
                            ),
                            array(
                                'Version',
                                '0.1.0 beta'
                            ),
                            array(
                                'Author',
                                'eliasmpjunior'
                            ),
                            array(
                                'Email',
                                'elias@brasidata.com.br'
                            ),
                            array(
                                'Homepage',
                                'https://brasidata.com.br'
                            ),
                        );

        try
        {
            Brasitable::printTable($tableHeader, $tableContent);
        }
        catch (BrasitableException $e)
        {
            throw new TableShowErrorException($e);
        }
	}
	/*
	protected $tableHeader = array();
	protected $columnWidth = array();
	protected $tableContent = array();

	public function __construct(array $tableHeader)
	{
		$this->tableHeader = $tableHeader;

		$this->checkTable();
	}

	public static function printTable(array $tableHeader, array $tableContent = array())
	{
		$currentTable = new Seeder($tableHeader);
		$currentTable->setTableContent($tableContent);
		$currentTable->printAll();
	}

	public function printAll()
	{
		Colors::line('');

		$this->setColumnWidth();
		$this->printHeader();
		$this->printContent();

		/**
		 * Print end line
		 *//*
		$this->printTableDivisor();

		Colors::line('');
	}

	public function setTableContent(array $tableContent)
	{
		$this->tableContent = $tableContent;

		$this->checkTable();
	}

	protected function checkTable()
	{
		$columnCount = count($this->tableHeader);

		/**
		 * Tables with no columns are not allowed
		 *//*
		if ($columnCount === 0)
		{
			throw new TableHeaderEmptyException;
		}

		/**
		 * Check table header
		 *//*
		$this->tableHeader = collect($this->tableHeader)
							->each(function ($item)
							{
								if (is_array($item) and ! array_key_exists('title', $item))
								{
									throw new TableHeaderColumnMissingTitleException($item);
								}
							})
							->map(function ($item)
							{
								if (is_array($item) and ! array_key_exists('color', $item))
								{
									$item['color'] = 'line';
								}

								return $item;
							})
							->all();
		/**
		 * Check each content line against header
		 *//*
		$lineWithError = collect($this->tableContent)
								->first(function ($contentLine)
								{
									return ! is_array($contentLine);
								});

		if (is_array($lineWithError))
		{
			throw new TableContentErrorException($lineWithError);
		}

		$columnCountOverFlow = collect($this->tableContent)
								->first(function ($contentLine, $lineNumber) use ($columnCount)
								{
								    return count($contentLine) > $columnCount;
								});

		if ( ! is_null($columnCountOverFlow))
		{
			throw new TableContentColumnCountOverflowException($columnCountOverFlow, $columnCount);
		}
	}

	protected function printHeader()
	{
		$columnWidth = $this->columnWidth;

		/**
		 * Prepare header to print
		 *//*
		$header = collect(array_values($this->tableHeader))
					->map(function ($item, $key) use ($columnWidth)
					{
						$headerCell = array();
						if (is_array($item))
						{
					    	$headerCell = array(
								    		'title' => $item['title'],
								    		'color' => $item['color'],
								    	);
						}
						else
						{
					    	$headerCell = array(
								    		'title' => $item,
								    		'color' => 'line',
								    	);
						}

						$headerCell['width'] = $columnWidth[$key];

					    return json_decode(
					    		json_encode(
					    			$headerCell
					    		)
					    	);
					});

		/**
		 * Print first line
		 *//*
		$this->printTableDivisor();

		/**
		 * Print table header
		 *//*
		Colors::nobr()->line('|');

		foreach ($header->all() as $key => $headerCell)
		{
			$colorFunction = $headerCell->color;

			Colors::nobr()->$colorFunction(' ');
			Colors::nobr()->$colorFunction($headerCell->title);
			for ($i = 0; $i <= ($headerCell->width - strlen($headerCell->title)); $i++)
			{
				Colors::nobr()->$colorFunction(' ');
			}

			Colors::nobr()->line('|');
		}

		Colors::line('');

		/**
		 * Print divisor line
		 *//*
		$this->printTableDivisor();
	}

	protected function printContent()
	{
		$columnWidth = $this->columnWidth;

		/**
		 * Prepare content to print
		 *//*
		$content = collect(array_values($this->tableContent))
					->map(function ($contentLineBefore) use ($columnWidth)
					{
						$contentLine = array();
						foreach ($contentLineBefore as $key => $item)
						{
							$contentCell = array();
							if (is_array($item))
							{
						    	$contentCell = array(
									    		'title' => $item['title'],
									    		'color' => $item['color'],
									    	);
							}
							else
							{
						    	$contentCell = array(
									    		'title' => $item,
									    		'color' => 'line',
									    	);
							}

							$contentCell['width'] = $columnWidth[$key];

							$contentLine[] = json_decode(
									    		json_encode(
									    			$contentCell
									    		)
									    	);
						}

						return $contentLine;
					});

		/**
		 * Print table content
		 *//*
		foreach ($content->all() as $key => $contentLine)
		{
			Colors::nobr()->line('|');

			foreach ($contentLine as $order => $contentCell)
			{
				$colorFunction = $contentCell->color;

				Colors::nobr()->$colorFunction(' ');
				Colors::nobr()->$colorFunction($contentCell->title);
				for ($i = 0; $i <= ($contentCell->width - strlen($contentCell->title)); $i++)
				{
					Colors::nobr()->$colorFunction(' ');
				}

				Colors::nobr()->line('|');
			}

			Colors::line('');
		}
	}

	protected function printTableDivisor()
	{
		Colors::nobr()->line('+');

		foreach ($this->columnWidth as $key => $lineCell)
		{
			for ($i = 0; $i < $lineCell + 2; $i++)
			{ 
				Colors::nobr()->line('-');
			}

			Colors::nobr()->line('+');
		}

		Colors::line('');
	}

	protected function setColumnWidth()
	{
		$headerWidth = collect($this->tableHeader)
							->map(function ($item)
							{
								if (is_array($item))
								{
							    	return strlen($item['title']);
								}

								return strlen($item);
							});

		$contentWidth = collect($this->tableContent)
							->map(function ($contentLine)
							{
								foreach ($contentLine as $key => $item)
								{
									if (is_array($item))
									{
								    	$contentLine[$key] = strlen($item['title']);
									}
									else
									{
										$contentLine[$key] = strlen($item);
									}
								}

								return $contentLine;
							});

		$this->columnWidth = $contentWidth
							->reduce(function ($columns, $contentLine)
							{
								$contentLine = array_values($contentLine);

								foreach ($columns as $key => $item)
								{
									if ($contentLine[$key] > $item)
									{
										$columns[$key] = $contentLine[$key];
									}
								}

								return $columns;

							}, $headerWidth->values()->all());
	}
	*/
}