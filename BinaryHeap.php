<?php

/**
 * BinaryHeap
 * Supports Insert and ExtractMax Operations
 * For Educational Purposes
 *  
 */
class BinaryHeap
{
    /**
     * @var array
     */
    private $values;

    public function __construct(array $values = [])
    {
        $this->values = $values;
    }

    public function print()
    {
        print_r($this->values);
    }

    public function insert($value)
    {
        $this->values[] = $value;
        $this->bubbleUp();
    }

    public function extractMax()
    {
        $max = reset($this->values);
        $end = array_pop($this->values);

        if (count($this->values)) {
            $this->values[0] = $end;
            $this->sinkDown();
        }

        return $max;
    }

    private function bubbleUp(): void
    {
        $idx = count($this->values) - 1;
        $endItem = $this->values[$idx];

        while ($idx > 0) {
            $parentIndex = floor(($idx - 1) / 2);
            $parentItem = $this->values[$parentIndex];

            if ($endItem <= $parentItem) {
                break;
            }

            $this->values[$parentIndex] = $endItem;
            $this->values[$idx] = $parentItem;
            $idx = $parentIndex;
        }
    }

    private function sinkDown()
    {
        $idx = 0;

        $length = count($this->values);

        while (true) {
            $element = $this->values[$idx];

            $swap = null;

            $leftChildIdx = (2 * $idx) + 1;

            $rightChildIdx = (2 * $idx) + 2;

            if ($leftChildIdx < $length) {
                $leftChild = $this->values[$leftChildIdx];
                if ($leftChild > $element) {
                    $swap = $leftChildIdx;
                }
            }

            if ($rightChildIdx < $length) {
                $rightChild = $this->values[$rightChildIdx];

                if ((!$swap && $rightChild > $element) || ($swap && $rightChild > $leftChild)) {
                    $swap = $rightChildIdx;
                }
            }

            if (!$swap) {
                break;
            }

            $this->values[$idx] = $this->values[$swap];
            $this->values[$swap] = $element;
            $idx = $swap;
        }
    }
}
