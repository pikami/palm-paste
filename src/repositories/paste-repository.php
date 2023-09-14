<?php
include_once "includes/config.php";

class PasteRepository
{
  private $conn;
  private $table_name = "pastes";

  public function __construct()
  {
    $this->conn = GetConnectionToDB();
  }

  function __destruct()
  {
    $this->conn = null;
  }

  // Create a new paste
  public function create($uid, $title, $text, $created, $expire, $exposure, $owner, $highlight)
  {
    $query = "INSERT INTO " . $this->table_name . " 
              (uid, title, text, created, expire, exposure, owner, highlight) 
              VALUES (:uid, :title, :text, :created, :expire, :exposure, :owner, :highlight)";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":uid", $uid);
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":text", $text);
    $stmt->bindParam(":created", $created);
    $stmt->bindParam(":expire", $expire);
    $stmt->bindParam(":exposure", $exposure);
    $stmt->bindParam(":owner", $owner);
    $stmt->bindParam(":highlight", $highlight);

    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // Read a paste by ID
  public function read($id)
  {
    $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Read a paste by UID
  public function readByUid($uid)
  {
    $query = "SELECT * FROM " . $this->table_name . " WHERE uid = :uid";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":uid", $uid);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Update a paste
  public function update($id, $uid, $title, $text, $created, $expire, $exposure, $owner, $highlight)
  {
    $query = "UPDATE " . $this->table_name . " SET
              uid = :uid,
              title = :title,
              text = :text,
              created = :created,
              expire = :expire,
              exposure = :exposure,
              owner = :owner,
              highlight = :highlight
              WHERE id = :id";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":uid", $uid);
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":text", $text);
    $stmt->bindParam(":created", $created);
    $stmt->bindParam(":expire", $expire);
    $stmt->bindParam(":exposure", $exposure);
    $stmt->bindParam(":owner", $owner);
    $stmt->bindParam(":highlight", $highlight);

    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // Delete a paste by ID
  public function delete($id)
  {
    $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":id", $id);

    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // Get pastes with a specific exposure value and limit
  public function getPastesWithExposure($exposureValue, $limit)
  {
    $query = "SELECT * FROM " . $this->table_name . " WHERE exposure = :exposureValue ORDER BY id DESC LIMIT :limit";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":exposureValue", $exposureValue, PDO::PARAM_INT);
    $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Remove expired pastes
  public function removeExpiredPastes()
  {
    $time = time();
    $query = "DELETE FROM " . $this->table_name . " WHERE `expire` < :time AND `expire` > 0";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':time', $time, PDO::PARAM_INT);

    if ($stmt->execute()) {
      return 'OK! 200';
    } else {
      return 'Error!';
    }
  }

  // Delete a paste by UID and owner
  public function deletePasteByUID($uid, $owner)
  {
    $query = "SELECT * FROM " . $this->table_name . " WHERE uid = :uid";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':uid', $uid);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($row['owner'] === $owner) {
          $deleteQuery = "DELETE FROM " . $this->table_name . " WHERE id = :id";
          $deleteStmt = $this->conn->prepare($deleteQuery);
          $deleteStmt->bindParam(':id', $row['id']);
          $deleteStmt->execute();

          return 'OK! 200';
        } else {
          return 'You are not the owner of the paste ' . $row['uid'];
        }
      }
    } else {
      return 'The paste ' . $uid . ' does not exist';
    }
  }

  // Generate a random unique UID for a new paste
  public function generateUniqueUID()
  {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $uid = '';

    // Maximum number of retries to find an unused name
    $maxRetries = 500;
    $tries = $maxRetries;

    do {
      if ($tries-- === 0) {
        throw new Exception('Gave up trying to find an unused name', 500);
      }

      for ($i = 0; $i < 8; $i++) {
        $uid .= $chars[mt_rand(0, 61)];
      }

      $query = "SELECT COUNT(uid) FROM " . $this->table_name . " WHERE uid = :uid";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':uid', $uid, PDO::PARAM_STR);
      $stmt->execute();
      $result = $stmt->fetchColumn();
    } while ($result > 0);

    return $uid;
  }

  // Get syntax highlight for a paste by UID
  public function getSyntaxHighlightByUID($uid)
  {
    $query = "SELECT highlight FROM " . $this->table_name . " WHERE uid = :uid";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':uid', $uid);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result['highlight'];
    } else {
      return "";
    }
  }

  // Get pastes by owner ID and exposure condition
  public function getPastesByOwner($ownerID, $includePrivate = false)
  {
    $query = "SELECT * FROM " . $this->table_name . " WHERE owner = :ownerID";

    if (!$includePrivate) {
      $query .= " AND exposure = 0";
    }

    $query .= " ORDER BY id DESC";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":ownerID", $ownerID);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
