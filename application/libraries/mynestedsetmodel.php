<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MyNestedsetModel
{

    private $CI;
    public $_table;
    public $_parent = 0;
    public $_level = 0;
    public $_data;
    public $_orderArr;

    public function __construct($params = array())
    {
        $this->CI =& get_instance();
        $this->_table = $params['tableName'];
    }

    /**
     * @param $parent is the parent of the children
     * @param $level is increased when we go deeper into the tree
     *
     * @return array
     */
    public function getTree($parent = 0, $level = 0, $excludeId = 0)
    {
        $this->CI->db->select(array('@parentLeft :=' => 'lft', '@parentRight :=' => 'rgt'));
        $this->CI->db->from($this->_table);
        $this->CI->db->where(array('parents' => $parent));
        //execute query
        $result = $this->CI->db->get();
        $result = $result->row();

        $this->CI->db->select('node.*');
        $this->CI->db->from($this->_table . ' AS node');
        $this->CI->db->where(array('node.lft >=' => $result->lft, 'node.rgt <=' => $result->rgt));

        if ($level != 0) {
            $this->CI->db->where(array('parents' => $parent));
        }

        if ($excludeId != 0 && $excludeId > 0) {
            $exclude = $this->CI->db->query('SELECT lft, rgt FROM ' . $this->_table . ' WHERE id=' . $excludeId);
            $exclude = $exclude->row();
            $this->CI->db->where(array('node.lft <' => $exclude->lft));
            $this->CI->db->or_where(array('node.rgt >' => $exclude->rgt));
        }

        $this->CI->db->order_by('node.lft');

        $result = $this->CI->db->get();

        return $result->result();
    }

    public function getNodeInfo($nodeId)
    {
        $result = $this->CI->db->get_where($this->_table, array('id' => $nodeId));

        return $result->row();
    }

    public function insertNode($data, $parent = 0, $options = null)
    {
        $this->_data = $data;
        $this->_parent = $parent;

        if ($options['position'] == 'right' || $options == null) $this->insertRight();

        if ($options['position'] == 'left') $this->insertLeft();

        if ($options['position'] == 'after') $this->insertAfter($options['brother_id']);

        if ($options['position'] == 'before') $this->insertBefore($options['brother_id']);

    }

    protected function insertRight()
    {

        $parentInfo = $this->getNodeInfo($this->_parent);
        $parentRight = $parentInfo->rgt;

        //$data = array('lft' => 'lft' + 2);
        $this->CI->db->where('lft >', $parentRight);
        $this->CI->db->set('lft', 'lft + 2', false);
        $this->CI->db->update($this->_table);
        //echo $this->CI->db->last_query(); return;

        //$data = array('rgt' => 'rgt + 2');
        $this->CI->db->where('rgt >=', $parentRight);
        $this->CI->db->set('rgt', 'rgt + 2', false);
        $this->CI->db->update($this->_table);

        $data = $this->_data;
        $data['lft'] = $parentRight;
        $data['rgt'] = $parentRight + 1;
        $data['level'] = $parentInfo->level + 1;

        $this->CI->db->insert($this->_table, $data);
    }

    public function updateNode($data, $id = null, $newParentId = 0)
    {
        if ($id != null && $id != 0) {
            $nodeInfo = $this->getNodeInfo($id);

            $this->CI->db->update($this->_table, $data, array('id' => $id));

        }

        if ($newParentId != null && $newParentId > 0) {
            if ($nodeInfo->parents != $newParentId) {
                if ($this->moveNode($id, $newParentId))
                    return true;
            }
        }

    }

    public function removeNode($id, $options = 'branch')
    {
        $this->_id = $id;

        if ($options == 'branch') $this->removeBranch();
        if ($options == 'node') $this->removeOne();
    }

    protected function removeBranch()
    {

        $infoNodeRemove = $this->getNodeInfo($this->_id);

        $rgtNodeRemove = $infoNodeRemove->rgt;
        $lftNodeRemove = $infoNodeRemove->lft;
        $widthNodeRemove = $this->widthNode($lftNodeRemove, $rgtNodeRemove);

        $this->CI->db->where('lft BETWEEN ' . $lftNodeRemove . ' AND ' . $rgtNodeRemove);
        $this->CI->db->delete($this->_table);

        $this->CI->db->where('lft > ' . $rgtNodeRemove);
        $this->CI->db->set('lft', 'lft - ' . $widthNodeRemove, false);
        $this->CI->db->update($this->_table);

        $this->CI->db->where('rgt > ' . $rgtNodeRemove);
        $this->CI->db->set('rgt', 'rgt - ' . $widthNodeRemove, false);
        $this->CI->db->update($this->_table);
    }

    public function moveNode($id, $parent = 0, $options = null)
    {
        $this->_id = $id;
        $this->_parent = $parent;

        if ($options['position'] == 'right' || $options == null) {
            if ($this->moveRight())
                return true;
            else
                return false;
        }

        if ($options['position'] == 'left') $this->moveLeft();

        if ($options['position'] == 'after') $this->movetAfter($options['brother_id']);

        if ($options['position'] == 'before') $this->moveBefore($options['brother_id']);
    }

    protected function moveRight()
    {

        try {
            $infoMoveNode = $this->getNodeInfo($this->_id);

            $lftMoveNode = $infoMoveNode->lft;
            $rgtMoveNode = $infoMoveNode->rgt;
            $widthMoveNode = $this->widthNode($lftMoveNode, $rgtMoveNode);

            $this->CI->db->where('lft BETWEEN ' . $lftMoveNode . ' AND ' . $rgtMoveNode);
            $this->CI->db->set(array('rgt' => "rgt - $rgtMoveNode", 'lft' => "lft - $lftMoveNode"), null, false);
            $this->CI->db->update($this->_table);

            $this->CI->db->where('rgt > ' . $rgtMoveNode);
            $this->CI->db->set(array('rgt' => "rgt - $widthMoveNode"), null, false);
            $this->CI->db->update($this->_table);

            $this->CI->db->where('lft > ' . $rgtMoveNode);
            $this->CI->db->set(array('lft' => 'lft -  ' . $widthMoveNode), null, false);
            $this->CI->db->update($this->_table);

            $infoParentNode = $this->getNodeInfo($this->_parent);
            $rgtParentNode = $infoParentNode->rgt;

            $this->CI->db->where(array('lft >= ' => $rgtParentNode, 'rgt > ' => 0));
            $this->CI->db->set(array('lft' => 'lft +  ' . $widthMoveNode), null, false);
            $this->CI->db->update($this->_table);

            $this->CI->db->where('rgt >= ' . $rgtParentNode);
            $this->CI->db->set(array('rgt' => 'rgt +  ' . $widthMoveNode), null, false);
            $this->CI->db->update($this->_table);

            $levelMoveNode = $infoMoveNode->level;
            $levelParentNode = $infoParentNode->level;
            $newLevelMoveNode = $levelParentNode + 1;

            $this->CI->db->where('rgt <= 0 ');
            $this->CI->db->set(array('level' => 'level -  ' . $levelMoveNode . ' + ' . $newLevelMoveNode), null, false);
            $this->CI->db->update($this->_table);

            $newParent = $infoParentNode->id;
            $newLeft = $infoParentNode->rgt;
            $newRight = $infoParentNode->rgt + $widthMoveNode - 1;

            $this->CI->db->where('id = ' . $this->_id);
            $this->CI->db->set(array('parents' => $newParent, 'lft' => $newLeft, 'rgt' => $newRight), null, false);
            $this->CI->db->update($this->_table);

            $this->CI->db->where('rgt < 0');
            $this->CI->db->set(array('rgt' => 'rgt + ' . $newRight, 'lft' => 'lft + ' . $newLeft), null, false);
            $this->CI->db->update($this->_table);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function widthNode($lft, $rgt)
    {
        $width = $rgt - $lft + 1;
        return $width;
    }

    public function orderTree($data, $orderArr)
    {

        $orderGroup = $this->orderGroup($data);
        $newOrderGroup = array();
        foreach ($orderGroup as $key => $val) {
            $tmpVal = array();
            foreach ($val as $key2 => $val2) {
                $tmpVal[$key2] = $orderArr[$key2];
            }
            natsort($tmpVal);
            $orderGroup[$key] = $tmpVal;
        }

        foreach ($orderGroup as $key => $val) {
            $tmpVal = array();
            foreach ($val as $key2 => $val2) {
                $info = $this->getNodeByLeft($key2);
                $tmpVal[$info['id']] = $val2;
            }
            $orderGroup[$key] = $tmpVal;
        }

        foreach ($orderGroup as $key => $val) {
            foreach ($val as $key2 => $val2) {
                $nodeID = $key2;
                $parent = $key;
                $this->moveNode($nodeID, $parent);
            }
        }
    }

    public function orderGroup($data = null)
    {
        if ($data != null) {
            $orderArr = array();
            if (count($data) > 0) {
                foreach ($data as $item) {
                    $orderArr[$item->id] = array();
                    if (isset($orderArr[$item->parents])) {
                        $orderArr[$item->parents][] = $item->lft;
                    }
                }
                $orderArr2 = array();
                foreach ($orderArr as $key => $val) {
                    $tmp = array();
                    $tmp = $orderArr[$key];
                    if (count($tmp) > 0) {
                        $orderArr2[$key] = array_flip($val);
                    }
                }

            }
        }
        $this->_orderArr = $orderArr2;
        return $this->_orderArr;
    }

    public function getNodeOrdering($parent, $left)
    {
        $ordering = $this->_orderArr[$parent][$left] + 1;
        return $ordering;
    }

    protected function getNodeByLeft($left)
    {
        $row = $this->CI->db->get_where($this->_table, 'lft = ' . $left);

        return $row->row_array();
    }
}

?>