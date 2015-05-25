<?php

namespace Comment\Model\Base;

use \Exception;
use \PDO;
use Comment\Model\Comment as ChildComment;
use Comment\Model\CommentQuery as ChildCommentQuery;
use Comment\Model\Map\CommentTableMap;
use Comment\Model\Thelia\Model\Customer;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'comment' table.
 *
 *
 *
 * @method     ChildCommentQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCommentQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method     ChildCommentQuery orderByCustomerId($order = Criteria::ASC) Order by the customer_id column
 * @method     ChildCommentQuery orderByRef($order = Criteria::ASC) Order by the ref column
 * @method     ChildCommentQuery orderByRefId($order = Criteria::ASC) Order by the ref_id column
 * @method     ChildCommentQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildCommentQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildCommentQuery orderByContent($order = Criteria::ASC) Order by the content column
 * @method     ChildCommentQuery orderByRating($order = Criteria::ASC) Order by the rating column
 * @method     ChildCommentQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildCommentQuery orderByVerified($order = Criteria::ASC) Order by the verified column
 * @method     ChildCommentQuery orderByAbuse($order = Criteria::ASC) Order by the abuse column
 * @method     ChildCommentQuery orderByFeatured($order = Criteria::ASC) Order by the featured column
 * @method     ChildCommentQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method     ChildCommentQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildCommentQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildCommentQuery orderBySortableRank($order = Criteria::ASC) Order by the sortable_rank column
 *
 * @method     ChildCommentQuery groupById() Group by the id column
 * @method     ChildCommentQuery groupByUsername() Group by the username column
 * @method     ChildCommentQuery groupByCustomerId() Group by the customer_id column
 * @method     ChildCommentQuery groupByRef() Group by the ref column
 * @method     ChildCommentQuery groupByRefId() Group by the ref_id column
 * @method     ChildCommentQuery groupByEmail() Group by the email column
 * @method     ChildCommentQuery groupByTitle() Group by the title column
 * @method     ChildCommentQuery groupByContent() Group by the content column
 * @method     ChildCommentQuery groupByRating() Group by the rating column
 * @method     ChildCommentQuery groupByStatus() Group by the status column
 * @method     ChildCommentQuery groupByVerified() Group by the verified column
 * @method     ChildCommentQuery groupByAbuse() Group by the abuse column
 * @method     ChildCommentQuery groupByFeatured() Group by the featured column
 * @method     ChildCommentQuery groupByLocale() Group by the locale column
 * @method     ChildCommentQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildCommentQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildCommentQuery groupBySortableRank() Group by the sortable_rank column
 *
 * @method     ChildCommentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCommentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCommentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCommentQuery leftJoinCustomer($relationAlias = null) Adds a LEFT JOIN clause to the query using the Customer relation
 * @method     ChildCommentQuery rightJoinCustomer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Customer relation
 * @method     ChildCommentQuery innerJoinCustomer($relationAlias = null) Adds a INNER JOIN clause to the query using the Customer relation
 *
 * @method     ChildComment findOne(ConnectionInterface $con = null) Return the first ChildComment matching the query
 * @method     ChildComment findOneOrCreate(ConnectionInterface $con = null) Return the first ChildComment matching the query, or a new ChildComment object populated from the query conditions when no match is found
 *
 * @method     ChildComment findOneById(int $id) Return the first ChildComment filtered by the id column
 * @method     ChildComment findOneByUsername(string $username) Return the first ChildComment filtered by the username column
 * @method     ChildComment findOneByCustomerId(int $customer_id) Return the first ChildComment filtered by the customer_id column
 * @method     ChildComment findOneByRef(string $ref) Return the first ChildComment filtered by the ref column
 * @method     ChildComment findOneByRefId(int $ref_id) Return the first ChildComment filtered by the ref_id column
 * @method     ChildComment findOneByEmail(string $email) Return the first ChildComment filtered by the email column
 * @method     ChildComment findOneByTitle(string $title) Return the first ChildComment filtered by the title column
 * @method     ChildComment findOneByContent(string $content) Return the first ChildComment filtered by the content column
 * @method     ChildComment findOneByRating(int $rating) Return the first ChildComment filtered by the rating column
 * @method     ChildComment findOneByStatus(int $status) Return the first ChildComment filtered by the status column
 * @method     ChildComment findOneByVerified(int $verified) Return the first ChildComment filtered by the verified column
 * @method     ChildComment findOneByAbuse(int $abuse) Return the first ChildComment filtered by the abuse column
 * @method     ChildComment findOneByFeatured(boolean $featured) Return the first ChildComment filtered by the featured column
 * @method     ChildComment findOneByLocale(string $locale) Return the first ChildComment filtered by the locale column
 * @method     ChildComment findOneByCreatedAt(string $created_at) Return the first ChildComment filtered by the created_at column
 * @method     ChildComment findOneByUpdatedAt(string $updated_at) Return the first ChildComment filtered by the updated_at column
 * @method     ChildComment findOneBySortableRank(int $sortable_rank) Return the first ChildComment filtered by the sortable_rank column
 *
 * @method     array findById(int $id) Return ChildComment objects filtered by the id column
 * @method     array findByUsername(string $username) Return ChildComment objects filtered by the username column
 * @method     array findByCustomerId(int $customer_id) Return ChildComment objects filtered by the customer_id column
 * @method     array findByRef(string $ref) Return ChildComment objects filtered by the ref column
 * @method     array findByRefId(int $ref_id) Return ChildComment objects filtered by the ref_id column
 * @method     array findByEmail(string $email) Return ChildComment objects filtered by the email column
 * @method     array findByTitle(string $title) Return ChildComment objects filtered by the title column
 * @method     array findByContent(string $content) Return ChildComment objects filtered by the content column
 * @method     array findByRating(int $rating) Return ChildComment objects filtered by the rating column
 * @method     array findByStatus(int $status) Return ChildComment objects filtered by the status column
 * @method     array findByVerified(int $verified) Return ChildComment objects filtered by the verified column
 * @method     array findByAbuse(int $abuse) Return ChildComment objects filtered by the abuse column
 * @method     array findByFeatured(boolean $featured) Return ChildComment objects filtered by the featured column
 * @method     array findByLocale(string $locale) Return ChildComment objects filtered by the locale column
 * @method     array findByCreatedAt(string $created_at) Return ChildComment objects filtered by the created_at column
 * @method     array findByUpdatedAt(string $updated_at) Return ChildComment objects filtered by the updated_at column
 * @method     array findBySortableRank(int $sortable_rank) Return ChildComment objects filtered by the sortable_rank column
 *
 */
abstract class CommentQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \Comment\Model\Base\CommentQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\Comment\\Model\\Comment', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCommentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCommentQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \Comment\Model\CommentQuery) {
            return $criteria;
        }
        $query = new \Comment\Model\CommentQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildComment|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CommentTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CommentTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return   ChildComment A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT ID, USERNAME, CUSTOMER_ID, REF, REF_ID, EMAIL, TITLE, CONTENT, RATING, STATUS, VERIFIED, ABUSE, FEATURED, LOCALE, CREATED_AT, UPDATED_AT, SORTABLE_RANK FROM comment WHERE ID = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            $obj = new ChildComment();
            $obj->hydrate($row);
            CommentTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildComment|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return ChildCommentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CommentTableMap::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildCommentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CommentTableMap::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCommentQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CommentTableMap::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CommentTableMap::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentTableMap::ID, $id, $comparison);
    }

    /**
     * Filter the query on the username column
     *
     * Example usage:
     * <code>
     * $query->filterByUsername('fooValue');   // WHERE username = 'fooValue'
     * $query->filterByUsername('%fooValue%'); // WHERE username LIKE '%fooValue%'
     * </code>
     *
     * @param     string $username The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCommentQuery The current query, for fluid interface
     */
    public function filterByUsername($username = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($username)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $username)) {
                $username = str_replace('*', '%', $username);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommentTableMap::USERNAME, $username, $comparison);
    }

    /**
     * Filter the query on the customer_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCustomerId(1234); // WHERE customer_id = 1234
     * $query->filterByCustomerId(array(12, 34)); // WHERE customer_id IN (12, 34)
     * $query->filterByCustomerId(array('min' => 12)); // WHERE customer_id > 12
     * </code>
     *
     * @see       filterByCustomer()
     *
     * @param     mixed $customerId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCommentQuery The current query, for fluid interface
     */
    public function filterByCustomerId($customerId = null, $comparison = null)
    {
        if (is_array($customerId)) {
            $useMinMax = false;
            if (isset($customerId['min'])) {
                $this->addUsingAlias(CommentTableMap::CUSTOMER_ID, $customerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($customerId['max'])) {
                $this->addUsingAlias(CommentTableMap::CUSTOMER_ID, $customerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentTableMap::CUSTOMER_ID, $customerId, $comparison);
    }

    /**
     * Filter the query on the ref column
     *
     * Example usage:
     * <code>
     * $query->filterByRef('fooValue');   // WHERE ref = 'fooValue'
     * $query->filterByRef('%fooValue%'); // WHERE ref LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ref The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCommentQuery The current query, for fluid interface
     */
    public function filterByRef($ref = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ref)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ref)) {
                $ref = str_replace('*', '%', $ref);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommentTableMap::REF, $ref, $comparison);
    }

    /**
     * Filter the query on the ref_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRefId(1234); // WHERE ref_id = 1234
     * $query->filterByRefId(array(12, 34)); // WHERE ref_id IN (12, 34)
     * $query->filterByRefId(array('min' => 12)); // WHERE ref_id > 12
     * </code>
     *
     * @param     mixed $refId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCommentQuery The current query, for fluid interface
     */
    public function filterByRefId($refId = null, $comparison = null)
    {
        if (is_array($refId)) {
            $useMinMax = false;
            if (isset($refId['min'])) {
                $this->addUsingAlias(CommentTableMap::REF_ID, $refId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($refId['max'])) {
                $this->addUsingAlias(CommentTableMap::REF_ID, $refId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentTableMap::REF_ID, $refId, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%'); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCommentQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email)) {
                $email = str_replace('*', '%', $email);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommentTableMap::EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCommentQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $title)) {
                $title = str_replace('*', '%', $title);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommentTableMap::TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the content column
     *
     * Example usage:
     * <code>
     * $query->filterByContent('fooValue');   // WHERE content = 'fooValue'
     * $query->filterByContent('%fooValue%'); // WHERE content LIKE '%fooValue%'
     * </code>
     *
     * @param     string $content The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCommentQuery The current query, for fluid interface
     */
    public function filterByContent($content = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($content)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $content)) {
                $content = str_replace('*', '%', $content);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommentTableMap::CONTENT, $content, $comparison);
    }

    /**
     * Filter the query on the rating column
     *
     * Example usage:
     * <code>
     * $query->filterByRating(1234); // WHERE rating = 1234
     * $query->filterByRating(array(12, 34)); // WHERE rating IN (12, 34)
     * $query->filterByRating(array('min' => 12)); // WHERE rating > 12
     * </code>
     *
     * @param     mixed $rating The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCommentQuery The current query, for fluid interface
     */
    public function filterByRating($rating = null, $comparison = null)
    {
        if (is_array($rating)) {
            $useMinMax = false;
            if (isset($rating['min'])) {
                $this->addUsingAlias(CommentTableMap::RATING, $rating['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rating['max'])) {
                $this->addUsingAlias(CommentTableMap::RATING, $rating['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentTableMap::RATING, $rating, $comparison);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus(1234); // WHERE status = 1234
     * $query->filterByStatus(array(12, 34)); // WHERE status IN (12, 34)
     * $query->filterByStatus(array('min' => 12)); // WHERE status > 12
     * </code>
     *
     * @param     mixed $status The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCommentQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(CommentTableMap::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(CommentTableMap::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentTableMap::STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the verified column
     *
     * Example usage:
     * <code>
     * $query->filterByVerified(1234); // WHERE verified = 1234
     * $query->filterByVerified(array(12, 34)); // WHERE verified IN (12, 34)
     * $query->filterByVerified(array('min' => 12)); // WHERE verified > 12
     * </code>
     *
     * @param     mixed $verified The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCommentQuery The current query, for fluid interface
     */
    public function filterByVerified($verified = null, $comparison = null)
    {
        if (is_array($verified)) {
            $useMinMax = false;
            if (isset($verified['min'])) {
                $this->addUsingAlias(CommentTableMap::VERIFIED, $verified['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($verified['max'])) {
                $this->addUsingAlias(CommentTableMap::VERIFIED, $verified['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentTableMap::VERIFIED, $verified, $comparison);
    }

    /**
     * Filter the query on the abuse column
     *
     * Example usage:
     * <code>
     * $query->filterByAbuse(1234); // WHERE abuse = 1234
     * $query->filterByAbuse(array(12, 34)); // WHERE abuse IN (12, 34)
     * $query->filterByAbuse(array('min' => 12)); // WHERE abuse > 12
     * </code>
     *
     * @param     mixed $abuse The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCommentQuery The current query, for fluid interface
     */
    public function filterByAbuse($abuse = null, $comparison = null)
    {
        if (is_array($abuse)) {
            $useMinMax = false;
            if (isset($abuse['min'])) {
                $this->addUsingAlias(CommentTableMap::ABUSE, $abuse['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($abuse['max'])) {
                $this->addUsingAlias(CommentTableMap::ABUSE, $abuse['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentTableMap::ABUSE, $abuse, $comparison);
    }

    /**
     * Filter the query on the featured column
     *
     * Example usage:
     * <code>
     * $query->filterByFeatured(true); // WHERE featured = true
     * $query->filterByFeatured('yes'); // WHERE featured = true
     * </code>
     *
     * @param     boolean|string $featured The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCommentQuery The current query, for fluid interface
     */
    public function filterByFeatured($featured = null, $comparison = null)
    {
        if (is_string($featured)) {
            $featured = in_array(strtolower($featured), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(CommentTableMap::FEATURED, $featured, $comparison);
    }

    /**
     * Filter the query on the locale column
     *
     * Example usage:
     * <code>
     * $query->filterByLocale('fooValue');   // WHERE locale = 'fooValue'
     * $query->filterByLocale('%fooValue%'); // WHERE locale LIKE '%fooValue%'
     * </code>
     *
     * @param     string $locale The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCommentQuery The current query, for fluid interface
     */
    public function filterByLocale($locale = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($locale)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $locale)) {
                $locale = str_replace('*', '%', $locale);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CommentTableMap::LOCALE, $locale, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCommentQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(CommentTableMap::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(CommentTableMap::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentTableMap::CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCommentQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(CommentTableMap::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(CommentTableMap::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentTableMap::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query on the sortable_rank column
     *
     * Example usage:
     * <code>
     * $query->filterBySortableRank(1234); // WHERE sortable_rank = 1234
     * $query->filterBySortableRank(array(12, 34)); // WHERE sortable_rank IN (12, 34)
     * $query->filterBySortableRank(array('min' => 12)); // WHERE sortable_rank > 12
     * </code>
     *
     * @param     mixed $sortableRank The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCommentQuery The current query, for fluid interface
     */
    public function filterBySortableRank($sortableRank = null, $comparison = null)
    {
        if (is_array($sortableRank)) {
            $useMinMax = false;
            if (isset($sortableRank['min'])) {
                $this->addUsingAlias(CommentTableMap::SORTABLE_RANK, $sortableRank['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sortableRank['max'])) {
                $this->addUsingAlias(CommentTableMap::SORTABLE_RANK, $sortableRank['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CommentTableMap::SORTABLE_RANK, $sortableRank, $comparison);
    }

    /**
     * Filter the query by a related \Comment\Model\Thelia\Model\Customer object
     *
     * @param \Comment\Model\Thelia\Model\Customer|ObjectCollection $customer The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCommentQuery The current query, for fluid interface
     */
    public function filterByCustomer($customer, $comparison = null)
    {
        if ($customer instanceof \Comment\Model\Thelia\Model\Customer) {
            return $this
                ->addUsingAlias(CommentTableMap::CUSTOMER_ID, $customer->getId(), $comparison);
        } elseif ($customer instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CommentTableMap::CUSTOMER_ID, $customer->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCustomer() only accepts arguments of type \Comment\Model\Thelia\Model\Customer or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Customer relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildCommentQuery The current query, for fluid interface
     */
    public function joinCustomer($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Customer');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Customer');
        }

        return $this;
    }

    /**
     * Use the Customer relation Customer object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Comment\Model\Thelia\Model\CustomerQuery A secondary query class using the current class as primary query
     */
    public function useCustomerQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCustomer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Customer', '\Comment\Model\Thelia\Model\CustomerQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildComment $comment Object to remove from the list of results
     *
     * @return ChildCommentQuery The current query, for fluid interface
     */
    public function prune($comment = null)
    {
        if ($comment) {
            $this->addUsingAlias(CommentTableMap::ID, $comment->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the comment table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CommentTableMap::DATABASE_NAME);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CommentTableMap::clearInstancePool();
            CommentTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildComment or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildComment object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public function delete(ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CommentTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CommentTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        CommentTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CommentTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     ChildCommentQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(CommentTableMap::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     ChildCommentQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(CommentTableMap::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     ChildCommentQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(CommentTableMap::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     ChildCommentQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(CommentTableMap::UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     ChildCommentQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(CommentTableMap::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     ChildCommentQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(CommentTableMap::CREATED_AT);
    }

    // sortable behavior

    /**
     * Returns the objects in a certain list, from the list scope
     *
     * @param     string $scopeRef Scope value for column `Ref`
     * @param     int $scopeRefId Scope value for column `RefId`
     *
     * @return    ChildCommentQuery The current query, for fluid interface
     */
    public function inList($scopeRef = null, $scopeRefId = null)
    {

        $scope[] = $scopeRef;
        $scope[] = $scopeRefId;


        static::sortableApplyScopeCriteria($this, $scope, 'addUsingAlias');

        return $this;
    }

    /**
     * Filter the query based on a rank in the list
     *
     * @param     integer   $rank rank
     * @param     string $scopeRef Scope value for column `Ref`
     * @param     int $scopeRefId Scope value for column `RefId`

     *
     * @return    ChildCommentQuery The current query, for fluid interface
     */
    public function filterByRank($rank, $scopeRef = null, $scopeRefId = null)
    {

        return $this
            ->inList($scopeRef, $scopeRefId)
            ->addUsingAlias(CommentTableMap::RANK_COL, $rank, Criteria::EQUAL);
    }

    /**
     * Order the query based on the rank in the list.
     * Using the default $order, returns the item with the lowest rank first
     *
     * @param     string $order either Criteria::ASC (default) or Criteria::DESC
     *
     * @return    ChildCommentQuery The current query, for fluid interface
     */
    public function orderByRank($order = Criteria::ASC)
    {
        $order = strtoupper($order);
        switch ($order) {
            case Criteria::ASC:
                return $this->addAscendingOrderByColumn($this->getAliasedColName(CommentTableMap::RANK_COL));
                break;
            case Criteria::DESC:
                return $this->addDescendingOrderByColumn($this->getAliasedColName(CommentTableMap::RANK_COL));
                break;
            default:
                throw new \Propel\Runtime\Exception\PropelException('ChildCommentQuery::orderBy() only accepts "asc" or "desc" as argument');
        }
    }

    /**
     * Get an item from the list based on its rank
     *
     * @param     integer   $rank rank
     * @param     string $scopeRef Scope value for column `Ref`
     * @param     int $scopeRefId Scope value for column `RefId`
     * @param     ConnectionInterface $con optional connection
     *
     * @return    ChildComment
     */
    public function findOneByRank($rank, $scopeRef = null, $scopeRefId = null, ConnectionInterface $con = null)
    {

        return $this
            ->filterByRank($rank, $scopeRef, $scopeRefId)
            ->findOne($con);
    }

    /**
     * Returns a list of objects
     *
     * @param     string $scopeRef Scope value for column `Ref`
     * @param     int $scopeRefId Scope value for column `RefId`

     * @param      ConnectionInterface $con    Connection to use.
     *
     * @return     mixed the list of results, formatted by the current formatter
     */
    public function findList($scopeRef = null, $scopeRefId = null, $con = null)
    {

        return $this
            ->inList($scopeRef, $scopeRefId)
            ->orderByRank()
            ->find($con);
    }

    /**
     * Get the highest rank
     *
     * @param     string $scopeRef Scope value for column `Ref`
     * @param     int $scopeRefId Scope value for column `RefId`
     * @param     ConnectionInterface optional connection
     *
     * @return    integer highest position
     */
    public function getMaxRank($scopeRef = null, $scopeRefId = null, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection(CommentTableMap::DATABASE_NAME);
        }
        // shift the objects with a position lower than the one of object
        $this->addSelectColumn('MAX(' . CommentTableMap::RANK_COL . ')');

        $scope[] = $scopeRef;
        $scope[] = $scopeRefId;


                static::sortableApplyScopeCriteria($this, $scope);
        $stmt = $this->doSelect($con);

        return $stmt->fetchColumn();
    }

    /**
     * Get the highest rank by a scope with a array format.
     *
     * @param     mixed $scope      The scope value as scalar type or array($value1, ...).

     * @param     ConnectionInterface optional connection
     *
     * @return    integer highest position
     */
    public function getMaxRankArray($scope, ConnectionInterface $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CommentTableMap::DATABASE_NAME);
        }
        // shift the objects with a position lower than the one of object
        $this->addSelectColumn('MAX(' . CommentTableMap::RANK_COL . ')');
        static::sortableApplyScopeCriteria($this, $scope);
        $stmt = $this->doSelect($con);

        return $stmt->fetchColumn();
    }

    /**
     * Get an item from the list based on its rank
     *
     * @param     integer   $rank rank
     * @param      int $scope        Scope to determine which suite to consider
     * @param     ConnectionInterface $con optional connection
     *
     * @return ChildComment
     */
    static public function retrieveByRank($rank, $scope = null, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection(CommentTableMap::DATABASE_NAME);
        }

        $c = new Criteria;
        $c->add(CommentTableMap::RANK_COL, $rank);
                static::sortableApplyScopeCriteria($c, $scope);

        return static::create(null, $c)->findOne($con);
    }

    /**
     * Reorder a set of sortable objects based on a list of id/position
     * Beware that there is no check made on the positions passed
     * So incoherent positions will result in an incoherent list
     *
     * @param     mixed               $order id => rank pairs
     * @param     ConnectionInterface $con   optional connection
     *
     * @return    boolean true if the reordering took place, false if a database problem prevented it
     */
    public function reorder($order, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection(CommentTableMap::DATABASE_NAME);
        }

        $con->beginTransaction();
        try {
            $ids = array_keys($order);
            $objects = $this->findPks($ids, $con);
            foreach ($objects as $object) {
                $pk = $object->getPrimaryKey();
                if ($object->getSortableRank() != $order[$pk]) {
                    $object->setSortableRank($order[$pk]);
                    $object->save($con);
                }
            }
            $con->commit();

            return true;
        } catch (\Propel\Runtime\Exception\PropelException $e) {
            $con->rollback();
            throw $e;
        }
    }

    /**
     * Return an array of sortable objects ordered by position
     *
     * @param     Criteria  $criteria  optional criteria object
     * @param     string    $order     sorting order, to be chosen between Criteria::ASC (default) and Criteria::DESC
     * @param     ConnectionInterface $con       optional connection
     *
     * @return    array list of sortable objects
     */
    static public function doSelectOrderByRank(Criteria $criteria = null, $order = Criteria::ASC, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection(CommentTableMap::DATABASE_NAME);
        }

        if (null === $criteria) {
            $criteria = new Criteria();
        } elseif ($criteria instanceof Criteria) {
            $criteria = clone $criteria;
        }

        $criteria->clearOrderByColumns();

        if (Criteria::ASC == $order) {
            $criteria->addAscendingOrderByColumn(CommentTableMap::RANK_COL);
        } else {
            $criteria->addDescendingOrderByColumn(CommentTableMap::RANK_COL);
        }

        return ChildCommentQuery::create(null, $criteria)->find($con);
    }

    /**
     * Return an array of sortable objects in the given scope ordered by position
     *
     * @param     int       $scope  the scope of the list
     * @param     string    $order  sorting order, to be chosen between Criteria::ASC (default) and Criteria::DESC
     * @param     ConnectionInterface $con    optional connection
     *
     * @return    array list of sortable objects
     */
    static public function retrieveList($scope, $order = Criteria::ASC, ConnectionInterface $con = null)
    {
        $c = new Criteria();
        static::sortableApplyScopeCriteria($c, $scope);

        return ChildCommentQuery::doSelectOrderByRank($c, $order, $con);
    }

    /**
     * Return the number of sortable objects in the given scope
     *
     * @param     int       $scope  the scope of the list
     * @param     ConnectionInterface $con    optional connection
     *
     * @return    array list of sortable objects
     */
    static public function countList($scope, ConnectionInterface $con = null)
    {
        $c = new Criteria();
        $c->add(CommentTableMap::SCOPE_COL, $scope);

        return ChildCommentQuery::create(null, $c)->count($con);
    }

    /**
     * Deletes the sortable objects in the given scope
     *
     * @param     int       $scope  the scope of the list
     * @param     ConnectionInterface $con    optional connection
     *
     * @return    int number of deleted objects
     */
    static public function deleteList($scope, ConnectionInterface $con = null)
    {
        $c = new Criteria();
        static::sortableApplyScopeCriteria($c, $scope);

        return CommentTableMap::doDelete($c, $con);
    }

    /**
     * Applies all scope fields to the given criteria.
     *
     * @param  Criteria $criteria Applies the values directly to this criteria.
     * @param  mixed    $scope    The scope value as scalar type or array($value1, ...).
     * @param  string   $method   The method we use to apply the values.
     *
     */
    static public function sortableApplyScopeCriteria(Criteria $criteria, $scope, $method = 'add')
    {

        $criteria->$method(CommentTableMap::REF, $scope[0], Criteria::EQUAL);

        $criteria->$method(CommentTableMap::REF_ID, $scope[1], Criteria::EQUAL);

    }

    /**
     * Adds $delta to all Rank values that are >= $first and <= $last.
     * '$delta' can also be negative.
     *
     * @param      int $delta Value to be shifted by, can be negative
     * @param      int $first First node to be shifted
     * @param      int $last  Last node to be shifted
     * @param      int $scope Scope to use for the shift
     * @param      ConnectionInterface $con Connection to use.
     */
    static public function sortableShiftRank($delta, $first, $last = null, $scope = null, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CommentTableMap::DATABASE_NAME);
        }

        $whereCriteria = new Criteria(CommentTableMap::DATABASE_NAME);
        $criterion = $whereCriteria->getNewCriterion(CommentTableMap::RANK_COL, $first, Criteria::GREATER_EQUAL);
        if (null !== $last) {
            $criterion->addAnd($whereCriteria->getNewCriterion(CommentTableMap::RANK_COL, $last, Criteria::LESS_EQUAL));
        }
        $whereCriteria->add($criterion);
                static::sortableApplyScopeCriteria($whereCriteria, $scope);

        $valuesCriteria = new Criteria(CommentTableMap::DATABASE_NAME);
        $valuesCriteria->add(CommentTableMap::RANK_COL, array('raw' => CommentTableMap::RANK_COL . ' + ?', 'value' => $delta), Criteria::CUSTOM_EQUAL);

        $whereCriteria->doUpdate($valuesCriteria, $con);
        CommentTableMap::clearInstancePool();
    }

} // CommentQuery
